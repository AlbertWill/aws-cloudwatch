<?php
if ( class_exists( 'AWS_Cloud_Watch' ) ) {
	return;
}

use Aws\CloudWatchLogs\CloudWatchLogsClient;

/**
 * Class AWS_Cloud_Watch
 */
class AWS_Cloud_Watch {

	/**
	 * Aws Cloud Watch Log Client.
	 *
	 * @var \Aws\CloudWatchLogs\CloudWatchLogsClient
	 */
	public $cloud_watch;

	/**
	 * Check if newrelic enabled or not to log error reporting.
	 *
	 * @var mixed|void
	 */
	public $is_newrelic_enabled;

	public $is_log_enabled;

	/**
	 * AWS_Cloud_Watch constructor.
	 */
	public function __construct() {
		require AWS_PLUGIN_BASE_DIR . '/config/aws-config.php';
		$this->config              = $config;
		$this->is_log_enabled      = apply_filters( 'aws_is_log_enabled', false );
		$this->is_newrelic_enabled = apply_filters( 'aws_is_newrelic_enabled', false );

		if ( empty( $this->config ) || ! $this->is_log_enabled ) {
			$this->cloud_watch = [];

			return;
		}

		$this->cloud_watch = new CloudWatchLogsClient( $this->config );
		date_default_timezone_set( 'UTC' );
	}

	/**
	 * Get List of log groups.
	 *
	 * @param int $limit
	 *
	 * @return \Aws\Result
	 */
	public function get_logs( $limit = 10 ) {
		if ( empty( $this->cloud_watch ) ) {
			return;
		}

		$result = $this->cloud_watch->describeLogGroups( [
			'limit' => $limit,
		] );

		return $result;
	}

	/**
	 * Check if a group exists or not.
	 *
	 * @param $name
	 *
	 * @return \Aws\Result|string
	 */
	public function get_log_group( $name ) {
		if ( empty( $name ) || empty( $this->cloud_watch ) ) {
			return;
		}

		$result = '';
		try {
			$result = $this->cloud_watch->ListTagsLogGroup( [
				'logGroupName' => apply_filters( 'aws_log_group_name', $name ),
			] );
		} catch ( \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $e ) {
			$this->log_error_response( $e );
		}

		return $result;
	}

	/**
	 * Create Log Group.
	 *
	 * @param $name
	 *
	 * @return \Aws\Result|string
	 */
	public function create_group( $name ) {
		if ( empty( $name ) || empty( $this->cloud_watch ) ) {
			return;
		}

		$result = '';
		try {
			$result = $this->cloud_watch->createLogGroup( [
				'logGroupName' => apply_filters( 'aws_log_group_name', $name ),
			] );
		} catch ( \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $e ) {
			$this->log_error_response( $e );
		}

		return $result;

	}

	/**
	 * Create Stream.
	 *
	 * @param $name
	 *
	 * @return \Aws\Result|string
	 */
	public function create_stream( $name ) {
		if ( empty( $name ) || empty( $this->cloud_watch ) ) {
			return;
		}

		$result = '';

		try {
			$result = $this->cloud_watch->createLogStream( [
				'logGroupName'  => apply_filters( 'aws_log_group_name', get_option(
					'aws_cloud_watch_group',
					AWS_CLOUD_WATCH_GROUP_NAME
				) ),
				'logStreamName' => apply_filters( 'aws_log_stream_name', $name ),
			] );
		} catch ( \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $e ) {
			$this->log_error_response( $e );
		}

		return $result;
	}

	/**
	 * Send Logs to Aws Cloud Watch.
	 *
	 * @param        $message
	 * @param string $type
	 *
	 * @return \Aws\Result|bool|string
	 */
	public function send_log( $message, $type = '' ) {

		if ( empty( $message ) || empty( $this->cloud_watch ) ) {
			return false;
		}

		$result      = '';
		$environment = defined( 'VIP_GO_ENV' ) ? VIP_GO_ENV : 'local';
		$recursive   = apply_filters( 'aws_cloud_watch_stream_recursive',
			get_option( 'aws_cloud_watch_stream_recursive', AWS_CLOUD_WATCH_STREAM_RECURSIVE ) );
		if( $recursive ) {
			$stream_name = date( 'Y.m.d' ) . '_' . $environment . '_' . time();
		}else{
			$stream_name = apply_filters( 'aws_log_stream_name', get_option( 'aws_log_stream_name', AWS_CLOUD_WATCH_STREAM_NAME ) );
		}

		$this->create_stream( $stream_name );

		$event = [
			'logGroupName'  => apply_filters( 'aws_log_group_name', get_option(
				'aws_cloud_watch_group',
				AWS_CLOUD_WATCH_GROUP_NAME
			) ),
			'logStreamName' => apply_filters( 'aws_log_stream_name', $stream_name ),
			'logEvents'     => [
				[
					'message'   => wp_json_encode( [
						'type' => $type,
						'data' => $message,
					] ),
					'timestamp' => round( microtime( true ) * 1000 ),
				],
			],
		];

		if ( ! empty( $this->get_sequence() ) ) {
			$event['sequenceToken'] = $this->get_sequence();
		}

		try {
			$result = $this->cloud_watch->putLogEvents( $event );
		} catch ( \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $e ) {
			$this->log_error_response( $e );
		}

		$sequencetoken = ( ! empty( $result ) && isset( $result['nextSequenceToken'] ) ) ? $result['nextSequenceToken'] : '';
		$this->insert_sequence( $sequencetoken );

		return $result;

	}

	/**
	 * Log newrelic if any error exception.
	 *
	 * @param \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $exception
	 */
	public function log_error_response( $exception ) {
		if ( $this->is_newrelic_enabled ) {
			newrelic_notice_error( 'Cloud Watch Error form Php Application', $exception );
		}
	}

	/**
	 * Insert Sequence id.
	 *
	 * @param $token
	 */
	public function insert_sequence( $token ) {
		$sequenc_id = $this->get_sequence();
		if ( empty( $sequenc_id ) ) {
			add_option( 'sequenceToken', $token );
		} else {
			update_option( 'sequenceToken', $token );
		}
	}

	/**
	 * Get sequence value.
	 *
	 * @return string sequenceToken Sequence Token
	 */
	public function get_sequence() {
		return get_option( 'sequenceToken', __return_empty_string() );
	}

}