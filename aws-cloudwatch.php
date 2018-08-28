<?php
/**
 * Plugin Name: Aws Cloud Watch
 * Plugin URI: https://github.com/arunchaitanyajami/aws-cloudwatch
 * Description:  Aws Cloud Watch
 * Version: 1.0
 * Author: Arun Chaitanya Jami
 * Author URI: https://github.com/achaitanyajami
 */

define( 'AWS_PLUGIN_BASE_DIR', __DIR__ );
define( 'AWS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'AWS_CLOUD_WATCH_GROUP_NAME', 'WordPress' );
define( 'AWS_CLOUD_WATCH_STREAM_NAME', 'WordPress' );
define( 'AWS_CLOUD_WATCH_STREAM_RECURSIVE', 'yes' );
define( 'AWS_SNS_TOPIC_ARN', '' );

if ( ! file_exists( AWS_PLUGIN_BASE_DIR . '/config/aws-config.php' ) ) {
	return;
}

require AWS_PLUGIN_BASE_DIR . '/vendor/autoload.php';
require AWS_PLUGIN_BASE_DIR . '/classes/class-aws-cloud-watch.php';
require AWS_PLUGIN_BASE_DIR . '/classes/class-aws-cloud-watch-admin.php';


/**
 * Get Logs form Aws Cloud Watch.
 *
 * @param int $limit
 *
 * @return \Aws\Result
 */
function aws_get_logs_from_cloud_watch( $limit = 10 ) {
	$cloud_watch = new AWS_Cloud_Watch();

	return $cloud_watch->get_logs( $limit );
}

/**
 * Get Log group form Aws Cloud Watch.
 */
function aws_get_loggroup( $name ) {
	$cloud_watch = new AWS_Cloud_Watch();

	return $cloud_watch->get_log_group( $name );
}

/**
 * Add Log Group to Aws Cloud Watch.
 *
 * @param $name
 *
 * @return \Aws\Result|string
 */
function aws_create_loggroup( $name ) {
	if ( empty( $name ) ) {
		return '';
	}

	$cloud_watch = new AWS_Cloud_Watch();

	return $cloud_watch->create_group( $name );
}

/**
 * Add Stream To cloud watch.
 *
 * @param $name
 *
 * @return \Aws\Result|string
 */
function aws_create_stream( $name ) {
	if ( empty( $name ) ) {
		return '';
	}

	$cloud_watch = new AWS_Cloud_Watch();

	return $cloud_watch->create_stream( $name );
}

/**
 * Add Cloud Watch Log.
 *
 * @param array|object|string $message
 * @param array|object|string $type
 * @param bool                $initial
 *
 * @return \Aws\Result|string
 */
function aws_add_log_to_cloud_watch( $message, $type, $initial = false ) {
	if ( empty( $message ) || empty( $type ) ) {
		return '';
	}

	$cloud_watch = new AWS_Cloud_Watch();

	return $cloud_watch->send_log( $message, $type, $initial );
}

/**
 * Plugin Activation.
 */
function aws_activate_plugin() {
	// On Activation Create A group.
	aws_create_loggroup(
		apply_filters(
			'aws_log_group_name',
			get_option(
				'aws_cloud_watch_group',
				AWS_CLOUD_WATCH_GROUP_NAME
			)
		)
	);

	$recursive = apply_filters( 'aws_cloud_watch_stream_recursive',
		get_option( 'aws_cloud_watch_stream_recursive', AWS_CLOUD_WATCH_STREAM_RECURSIVE ) );

	if ( 'no' === $recursive ) {
		$stream_name = apply_filters( 'aws_log_stream_name',
			get_option( 'aws_log_stream_name', AWS_CLOUD_WATCH_STREAM_NAME ) );
		aws_create_stream( $stream_name );
	}
}

register_activation_hook( __FILE__, 'aws_activate_plugin' );


/**
 * If NewRelic Enabled.
 */
add_filter( 'aws_is_newrelic_enabled', function ( $args ) {
	if ( extension_loaded( 'newrelic' ) ) {
		return true;
	}

	return false;
}, 100 );

/**
 * Decrypt aws key stored in database.
 *
 * @param $value
 *
 * @return string
 */
function thesun_aws_secret( $value ) {
	if ( empty( $value ) ) {
		return '';
	}

	$aws_admin = new AWS_Cloud_Watch_Admin();

	return $aws_admin->decrypt( $value );
}

add_filter( 'aws_set_region', 'thesun_aws_secret', 10 );
add_filter( 'aws_set_secret', 'thesun_aws_secret', 10 );
add_filter( 'aws_set_key', 'thesun_aws_secret', 10 );
