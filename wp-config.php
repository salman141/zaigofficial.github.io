<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zaig' );

/** MySQL database username */
define( 'DB_USER', 'azuu' );

/** MySQL database password */
define( 'DB_PASSWORD', 'azuu123*' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'c3rM17<UPjIsKD!Op!r9Z/M!r}S/4V{03|;GweCr(`H)m_fg>_V]y<TqQoxKQHz6' );
define( 'SECURE_AUTH_KEY',  'n }oSc.E<I[H&bI3m{3}}hA9!<S7eE0rbTSMS=u7(<Oe?MwG;S^{S:J3%us>ceWv' );
define( 'LOGGED_IN_KEY',    'U&O/U/Y_F]omqA7p5hl&a: clc)Q?w@uujGMss$kxzskzHUCcz9}(-Ee=(]9nC^K' );
define( 'NONCE_KEY',        '3S)?#Uw7t7_QmFAVTA0S7[[},@*Bx;n&[bq.c^.-OMj=m%)*yy*kEwNg` __Ag*x' );
define( 'AUTH_SALT',        '$ $z%dlPQW$<dBL6xtK9c{I3a gVYY.v.V3$f!J%Dg}3G Kg<5d?D s*f-W6Bb{j' );
define( 'SECURE_AUTH_SALT', ' :q(($.j^hl@bRB}%[q>_6VZr6]@sg3#F=E*W`yL/Kqt>$`h{Je_b*OSZ/3M-S]M' );
define( 'LOGGED_IN_SALT',   'UidQ?U@[kSqB+Fi8+zck5z8MYVDT]BJBh*J@@?6G1d2NSL>A6Sk]~%Pe#IVu-B@p' );
define( 'NONCE_SALT',       '$+L:7$WD?>pv5]3O3Mq8hD_C.Wc8m#2}Evo*?xQBGtwWy%..3{l|3CFP]{[+x8IZ' );

/**#@-*/

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
