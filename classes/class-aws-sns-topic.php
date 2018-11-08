<?php
/**
 * CCS Configuration.
 *
 * @package    WordPress
 * @subpackage The Sun Theme
 */

use Aws\Sns\SnsClient;

class AWS_Sns_Topic {

	protected $sns;

	protected $is_feature_enabled;

	protected $config;

	protected $environment;

	protected $topic_arn;

	public function __construct() {
		require AWS_PLUGIN_BASE_DIR . '/config/aws-config.php';
		$this->config = $config;
		$this->is_feature_enabled = apply_filters( 'aws_sns_enabled', false );
		$this->environment = defined( 'VIP_GO_ENV' ) ? VIP_GO_ENV : 'local';
		$this->topic_arn = get_option( 'aws_sns_topic_arn', 0 );
		$this->sns = new SnsClient($this->config);
	}

	public function publish_message( $message, $feed = 'feedName', $type = 'post' ) {

		if ( strpos($this->topic_arn, 'arn:aws:') !== false ) {
			$result = $this->sns->publish([
				// create a settings page somewhere to set this..
				'TopicArn' => $this->topic_arn,
				'Message' => $message,
				'MessageAttributes' => [
					'causationId' => [
						'DataType' => 'String',
						'StringValue' => '0'
					],
					'messageId' => [
						'DataType' => 'String',
						'StringValue' => uniqid('', true)
					],
					'correlationId' => [
						'DataType' => 'String',
						'StringValue' => uniqid('', true)
					]
				],
				'Subject' => 'New CCS request for type: ' . $type . ', feed: ' . $feed
			]);

			return $result->toArray();
		}

		return [];
	}
}
