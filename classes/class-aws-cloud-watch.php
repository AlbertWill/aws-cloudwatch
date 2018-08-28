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

	/**
	 * Is logs Enabled.
	 *
	 * @var mixed|void
	 */
	public $is_log_enabled;

	/**
	 * Group Name
	 */
	public $group_name;

	/**
	 * Stream Name
	 */
	public $stream_name;

	/**
	 * Stream Name
	 */
	public $stream_recursive;

	/**
	 * AWS_Cloud_Watch constructor.
	 */
	public function __construct() {
		require AWS_PLUGIN_BASE_DIR . '/config/aws-config.php';
		$this->config              = $config;
		$this->is_log_enabled      = apply_filters( 'aws_is_log_enabled', false );
		$this->is_newrelic_enabled = apply_filters( 'aws_is_newrelic_enabled', false );
		$this->group_name          = apply_filters( 'aws_log_group_name', get_option(
			'aws_cloud_watch_group',
			AWS_CLOUD_WATCH_GROUP_NAME
		) );
		$environment               = defined( 'VIP_GO_ENV' ) ? VIP_GO_ENV : 'local';
		$this->stream_recursive    = apply_filters( 'aws_cloud_watch_stream_recursive', get_option(
			'aws_cloud_watch_stream_recursive',
			AWS_CLOUD_WATCH_STREAM_RECURSIVE
		) );

		if ( 'yes' === $this->stream_recursive ) {
			$this->stream_name = date( 'Y.m.d' ) . '_' . $environment . '_' . time();
		} else {
			$this->stream_name = apply_filters( 'aws_log_stream_name', get_option( 'aws_log_stream_name', AWS_CLOUD_WATCH_STREAM_NAME ) );
		}

		if ( empty( $this->config ) || ! $this->is_log_enabled ) {
			$this->cloud_watch = [];

			return;
		}

		$this->cloud_watch = new CloudWatchLogsClient( $this->config );
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
				'logGroupName' => $this->group_name,
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
				'logGroupName'  => $this->group_name,
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
	 * @param bool   $initial
	 *
	 * @return \Aws\Result|bool|string
	 */
	public function send_log( $message, $type = '', $initial = false ) {

		if ( empty( $message ) || empty( $this->cloud_watch ) ) {
			return;
		}

		$result = '';
		if ( 'yes' === $this->stream_recursive ) {
			$this->create_stream( $this->stream_name );
		}

		$event = [
			'logGroupName'  => $this->group_name,
			'logStreamName' => $this->stream_name,
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

		if ( 'no' === $this->stream_recursive && ! $initial ) {
			$event['sequenceToken'] = $this->get_sequence();
		}

		try {
			$result = $this->cloud_watch->putLogEvents( $event );
		} catch ( \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $e ) {
			$this->log_error_response( $e );
		}

		return $result;

	}

	/**
	 * Log newrelic if any error exception.
	 *
	 * @param \Aws\CloudWatchLogs\Exception\CloudWatchLogsException $exception
	 *
	 * @return bool
	 */
	public function log_error_response( $exception ) {
		if ( $this->is_newrelic_enabled ) {
			newrelic_notice_error( 'Cloud Watch Error form Php Application', $exception );
		}

		return true;
	}

	/**
	 * Get sequence value.
	 *
	 * @return string sequenceToken Sequence Token
	 */
	public function get_sequence() {
		if ( empty( $this->cloud_watch ) ) {
			return;
		}

		$response = $this->cloud_watch->describeLogStreams( [
			'logGroupName'        => $this->group_name,
			'logStreamNamePrefix' => $this->stream_name,
		] );

		return $response['logStreams']['0']['uploadSequenceToken'];
	}

}