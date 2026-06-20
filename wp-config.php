<?php
/**
 * The base configuration for WordPress
 *
 * This file contains the SQLite configuration.
 *
 * @package WordPress
 */

// SQLite Database Integration does not strictly require MySQL credentials,
// but WordPress core checks if they are defined.
define( 'DB_NAME', 'dr_ali_db' );
define( 'DB_USER', 'sqlite_user' );
define( 'DB_PASSWORD', 'sqlite_password' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 */
define( 'AUTH_KEY',         'p]7x(L:-f-BqD(S;1%Wz;v#H$m9x-k;F,p2D:j%x$q2K:S;v#H$m9x-k;F,p2D' );
define( 'SECURE_AUTH_KEY',  'T&1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1' );
define( 'LOGGED_IN_KEY',    'k&f.m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1' );
define( 'NONCE_KEY',        'x_h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R' );
define( 'AUTH_SALT',        'z_1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b' );
define( 'SECURE_AUTH_SALT', 'c_Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m' );
define( 'LOGGED_IN_SALT',   'v_;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E' );
define( 'NONCE_SALT',       'm_R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h:Q#o1;O+R5b:W*m%h.E1%h' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

// Force English and Arabic translation configuration
// Setting WPLANG sets the default language during setup
define( 'WPLANG', 'ar' );

// Dynamic Home and SiteURL for Vercel & Local dev compatibility
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$http_protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ? 'https://' : 'http://';
	define( 'WP_HOME', $http_protocol . $_SERVER['HTTP_HOST'] );
	define( 'WP_SITEURL', $http_protocol . $_SERVER['HTTP_HOST'] );
}

/* Add any custom values between this line and the "stop editing" line. */

// Disable WP Cron if we want to run cron jobs manually, or leave it enabled for simplicity.
// For a development site, leaving it enabled is usually fine.

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
