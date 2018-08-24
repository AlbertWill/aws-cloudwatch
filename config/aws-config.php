<?php
/**
 * Configuration file.
 */
$config     = [];
$aws_region = apply_filters( 'aws_set_region', get_option( 'aws_region', '' ) );
$aws_key    = apply_filters( 'aws_set_key', get_option( 'aws_key', '' ) );
$aws_secret = apply_filters( 'aws_set_secret', get_option( 'aws_secret', '' ) );

if ( $aws_region && $aws_key && $aws_secret ) {
	$config = [
		'region'           => $aws_region,
		'version'          => 'latest',
		'correctClockSkew' => true,
		'credentials'      => [
			'key'    => $aws_key,
			'secret' => $aws_secret,
		],
	];
}