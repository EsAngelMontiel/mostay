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
define( 'DB_NAME', 'jztmyfib_mostay' );

/** MySQL database username */
define( 'DB_USER', 'jztmyfib_mostay' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dusru4-hamDyj-gospej*' );

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
define('AUTH_KEY',         'VK>u3oYE$5DZ+iRzx$MKU.}vI0+KNj_3Ns|Z-K9||o.+N(]ilo#>9/n*Ye.1(4{S');
define('SECURE_AUTH_KEY',  '{Sso#784L1,uN)7xL<t!p~^v$C]PM-bQ!_9-]^g#*w1TyqPm@@zZ*c7.lWmd2i49');
define('LOGGED_IN_KEY',    'o<v7Us;F<8%N,smBoD}|9W`T>h.VkY-t&|E=D#+:%tq_ 2[}%}Sz&z+oW4d{?>fc');
define('NONCE_KEY',        'Bz4)OI6qW`u]<(!3nOXjmvHs-UMN{:r+p)jR+.S 12>8N|}eq@v=60]j=Po2*Ex2');
define('AUTH_SALT',        ';><RuBh6/M$GR8tF_!vx{o:3jeW]:@Ku|v?|r$_EWDUuf}$d<|&R%gP{^O#5xP)>');
define('SECURE_AUTH_SALT', '`1SO.py*+c,YVJ|kZ{d= >r&2ba1re N[_*5yx;$zNS%/}IOOPr}%m%sw*g*Ng[g');
define('LOGGED_IN_SALT',   '.Elm]3(a]pM?]7mO|$X`Uj@?-m.4`qm0eKcSO2@;T?yKmzM|_#Y=(drf{2$J(qz2');
define('NONCE_SALT',       '_hJ:,BH).q7;acp42N;pM-UM t{0udf)[iqi7-QOySvKRjF*.A<{HhY:?+>.8t^$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mos_';

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













