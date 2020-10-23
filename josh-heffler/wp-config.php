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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'josh_heffler' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_DEBUG', false );
define('FS_METHOD','direct');
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'Lu>$fcp^Xpb;?W++djnVoMbsRv ~BjONGxo)ez(m9f6Qwt#`bR}:NnYDU2qD26>0' );
define( 'SECURE_AUTH_KEY',   'NA87HW|${dCnM21?u@ODo]i* YnVJ}))fqX@-V SuY5:P<.rOil,14nF{b|Wd&SP' );
define( 'LOGGED_IN_KEY',     't>o,`?O*^w-@N{UQrkMvYozTeN5/8Lky-VR9B/Q3O?I`_-2qI:F^UCCaLFOiPH64' );
define( 'NONCE_KEY',         'NJ(Bf31OcR%~c|(QDg,?jy[M*2Kr,Xr0cSz}?RiS`%m5/x. &!GK #0mCwgMS&yG' );
define( 'AUTH_SALT',         'K8:xqTsXDe8Q0=+y9,ikxN>v5},4)$2BgiSt2Xo|&D*W%|?w(Kk)^!q+xEc_Blw=' );
define( 'SECURE_AUTH_SALT',  '.b{;#Oa>Yj5A,IY7U$PD[5T{K[voT#XDU-p^apW=UD-rA_Q(#r.dmHsQ`<f=q4/_' );
define( 'LOGGED_IN_SALT',    'p@1&JFp-;i]XcsWnw)zjUhe(28;2P] 4lvecm?FT6*23^pf8`x|Em7)#1HmGo]R}' );
define( 'NONCE_SALT',        '@90P;)vsK0cKUI)z.2j9mx09phC|Sogo^.i)>T77G{|1CH&H5*HJJ! rgzkB6z!)' );
define( 'WP_CACHE_KEY_SALT', 'U=F*%4urDvSh6MzuWr#*oFU/WAkAy 2;aEO*n=AQ{Tl3z61o@>({] iyh/a7n/fU' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
