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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressdemo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'bxXF]Et)JYL:<&BtZ)mM&@+o9fr<,6&L:>ltJ>v*K,-p@P9:+eN0_/r5k74xg2xP' );
define( 'SECURE_AUTH_KEY',  '#0RqEV3j*c?<!~B$P{~jy%:1K8[=C@K #~kVzffOoEZa2M`z;E`J.p,u)q J2$>5' );
define( 'LOGGED_IN_KEY',    '!M#J!~Tu^WSWux> t3HB.K:c]IMNV0V$5+a=gIBy9O +vr;*:ywlB|O(KD%>F}zd' );
define( 'NONCE_KEY',        ' H%tdsvR(7r4T~Nd7[mbgQye%lH_|6vRkkw +5}o08vo*7mX:!6qG.yyOcZ<3:Sn' );
define( 'AUTH_SALT',        'ny*fvd^T] =67<o#NNPY*y%}Zh/5mT0_sDGM_jcZv~;u}/+zW4J:(.KvgsQlrzd<' );
define( 'SECURE_AUTH_SALT', 'jY&R|W.8tXER<iocNNdsIm]~v8/|6&RX#PH aM@vh[H4DgL1=9(6#Ghf>a#R`C>4' );
define( 'LOGGED_IN_SALT',   '9H=i-vaId04OJOX|^K; %x4ml,>Gq<rE?!ie0[+~,Y<4GtqkuSW.{c{{R(n; O*l' );
define( 'NONCE_SALT',       '.Dfo61uSlVm{i0>6OeA :v(T7_I7Gn6%l{SV0`s&&)ec$8=qL!^mG<FciC{6J|33' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
