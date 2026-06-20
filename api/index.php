<?php
/**
 * Vercel Serverless Entry Point and Front Controller for WordPress
 */

// Define ABSPATH pointing to the parent directory (project root)
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__ ) . '/' );
}

$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$parsed_url  = parse_url( $request_uri );
$path        = ltrim( $parsed_url['path'] ?? '', '/' );

// Default path if empty
if ( empty( $path ) ) {
	$path = 'index.php';
}

// Append index.php if path points to an existing directory
if ( is_dir( ABSPATH . $path ) ) {
	$path = rtrim( $path, '/' ) . '/index.php';
}

$target_file = realpath( ABSPATH . $path );

// Check if the target is a valid PHP file inside the ABSPATH root and is not wp-config.php
if ( $target_file 
	&& strpos( $target_file, realpath( ABSPATH ) ) === 0 
	&& is_file( $target_file ) 
	&& pathinfo( $target_file, PATHINFO_EXTENSION ) === 'php'
	&& basename( $target_file ) !== 'wp-config.php'
) {
	// Configure environment variables to mock direct execution
	$_SERVER['SCRIPT_FILENAME'] = $target_file;
	$_SERVER['SCRIPT_NAME']     = '/' . $path;
	$_SERVER['PHP_SELF']        = '/' . $path;
	
	// Shift working directory to the target file's directory
	chdir( dirname( $target_file ) );
	
	// Execute the target file
	require_once $target_file;
	exit;
}

// Otherwise, let WordPress handle the request as a permalink
define( 'WP_USE_THEMES', true );
require_once ABSPATH . 'wp-blog-header.php';
