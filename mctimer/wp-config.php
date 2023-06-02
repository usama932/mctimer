<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dtbuxxmy_WPU6D');

/** Database username */
define('DB_USER', 'dtbuxxmy_WPU6D');

/** Database password */
define('DB_PASSWORD', '-O=kkZ$SdhY@e?#/K');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '6fbff78f4e6ad21be938128470f7f634ac939a944782bc811f7d706e273e9cd8');
define('SECURE_AUTH_KEY', '75893ff0b1d93b05e02168dfcaa8192d33a31c4150f9f4b3b492d77dd99a8e76');
define('LOGGED_IN_KEY', 'c12cbf21eaad2b1b6f99e80e8d4dfc13a5c8bd3869d7a48f19aefe7436528ca8');
define('NONCE_KEY', 'd5978f2704341e5749903649ee5e43cdf4baa80e8887d114dc5d623b3eac0407');
define('AUTH_SALT', 'f661049ffa5ae1bda6e8b49a2693ba769b57447940f1838d1df3f25b2b0b1bed');
define('SECURE_AUTH_SALT', '9a9e80fcc5a97fd3ce18de30a083a875c48b3463a077fc5c10c66dcd3b1cc4a4');
define('LOGGED_IN_SALT', '54e7d31e870a2b9718d60091ebfef58d671f97a74baa3e08a8cb0f1b7885296f');
define('NONCE_SALT', 'e7b33259a1a3927fad36b39bd3894cbf9ec79cd2721f5c1a32484c439fa43e4f');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hgR_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 20);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
