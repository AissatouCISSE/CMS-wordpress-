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
define( 'DB_NAME', 'hackeuses' );

/** MySQL database username */
define( 'DB_USER', 'aissatou' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         'zLhV.UqqEI9RFxf:[F:cj!`T!kxzWJZaF%r+TIP|-IVbH;bvw ^5>r4Q%*~8.Boe' );
define( 'SECURE_AUTH_KEY',  '<+)$m3L)f%Kxs]:|1L!n:Or:`rS;v!g|P_363dr`?wYh&|pX&nvi<__7`>SqD03p' );
define( 'LOGGED_IN_KEY',    'H?jbVjak9EFzTjyv=Nu2=]1%>0=Qf#+wfxF~q%I7W 7V7(_ O~pD GI6MzSbhXpl' );
define( 'NONCE_KEY',        'kv8VR|[><Hl77BptFm@Yv%?@u/KtPOpf-Nr8VqS`)0q`n#BVQ6u7XBB-%Me8He8x' );
define( 'AUTH_SALT',        '!eaE{%8n*jf=)FRWx<)>*hse};T@7O=.K:<K]sJ&CR6Je|kzxUUWs34`b}H+.|OW' );
define( 'SECURE_AUTH_SALT', 'IcewD_M-R~IZmA&Rw:bh ]C{bfEF$Lf:zXnG:q=w>@<XzsC}l:4|-ObLzCzE74e ' );
define( 'LOGGED_IN_SALT',   'oM1paJ!@l|JCj+`]:?bt@daMwGBylP|a) |NVNU=!$AS<j)Mio/`r<XJMVi@43~J' );
define( 'NONCE_SALT',       'w*1(-/} x/ )Nu3,(*ty0z&}~(m .dMBHu,[h>#)#n}4=1gS,+K=HQcy(I?VtbIe' );

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
