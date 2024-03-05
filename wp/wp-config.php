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
define( 'DB_NAME', 'rutc24rtsummit' );

/** Database username */
define( 'DB_USER', 'rutc24rtsummit' );

/** Database password */
define( 'DB_PASSWORD', 'rutc24@rtsummit' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'LKO(GScQNZGbWN)7}2KPExom[467fNO#Ij*A426n>D5`}VE@+jCj>N1u9|5J214?' );
define( 'SECURE_AUTH_KEY',  'i+RpybnNcjXtG9d$.SlY_5N?Xjv%>=dNtYJJ&VY.v!$Y!(F0& q$;1H6Q?2A?+y^' );
define( 'LOGGED_IN_KEY',    'v@ iM=v@BHm tpK2Q@*{B,T`]Yq@~`$9t%$Tu<6Bs!qH:e#_@nSbeYBpE<_owcjM' );
define( 'NONCE_KEY',        '&{3;(V4~quG0*%Y_!{2j-(j-lUq6+DK^X}^o>J`(qX0|eR&>bdz^+G4xB4x&vMY{' );
define( 'AUTH_SALT',        'gmnqTY<&KT 7%{mUB4O(sjd@RIM4X8KOVR*&+`IL>f*d]S/yf}TNw$E5lLF2q@)r' );
define( 'SECURE_AUTH_SALT', '^m;(q#at.rj{5(pb`_rp9Go}B9k4Jp#J>ouIkQQeejlAE<3(%hT!hafvB0,tz^:;' );
define( 'LOGGED_IN_SALT',   'G$w+}^9|+C8u=6([GwgS*Q;j=g99Da8xO;) a$H7g=p&`#}@<(JsbH/8[K]QZt[g' );
define( 'NONCE_SALT',       'w.=2[wJ=/Bdm?wpb)Y N{|O9yGx/!qW#)]q%MH?I{Kg{$F[drt37p8YMF,H|{i),' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */

/* custom security setting */
define('DISALLOW_FILE_EDIT',true);
define('IMAGE_EDIT_OVERWRITE',true);
define('EMPTY_TRASH_DAYS',7);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/* enable core major update */
define( 'WP_AUTO_UPDATE_CORE', 'true' );
