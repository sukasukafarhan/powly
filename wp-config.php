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
define( 'DB_NAME', 'powlyskin' );

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
define( 'AUTH_KEY',         'V-p]w+RS/u}y>S~?8m|QF#)d<p/.(mZh1No9CrvoxKj!QkeT1J9F(Y)xf%] [CSL' );
define( 'SECURE_AUTH_KEY',  'm4g)W1NS+^u,T]{S&m^aTX/1U$?x*;xg^U^z4V_S2T#r.4h6]e9*</934,x4v*&t' );
define( 'LOGGED_IN_KEY',    'OzX?#r#A@&vxVitHF0CFKpprbvQz`EDCLh{1sVSZ++KT~^q5+NGnPZ1aL#P= }M?' );
define( 'NONCE_KEY',        'GC.i(12f>[,?RU4i<=vElW#aOGTNYOMc $}}v0B:vEo!#Y,LvS5=N]I :t*2]bA+' );
define( 'AUTH_SALT',        '6Wz%}[jsf_Pt4gdTi(mw 4!Wjq+Y2IS=X|ArbfLBF.7Z6x.gvm<a6v$bCHo4V=]a' );
define( 'SECURE_AUTH_SALT', 'Zq>&hTFj(YvQC+>A*(`^1;G+L(_3ft=b&Jh )OyNwWuj<gGj q=Eq4qJf ]9F.|%' );
define( 'LOGGED_IN_SALT',   '09a74]uskpyKyGa3U^LzoRJSR8)B>51N!-QlE[2 Hk0$%vjNW&)S{Ys[-;alX_S`' );
define( 'NONCE_SALT',       'h/i~.N0W|dLL.{*XTFgAR)Bp77rRk.V}b!tB]4d-[[b|M?m2-7^/!]>T =~kY[]l' );

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
