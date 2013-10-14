<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('WPCACHEHOME','/home/httpd/QuickCommerce/wp-content/plugins/wp-super-cache/');
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'quickcommerce');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ZInNqRNls(IWQAF7FDixeO^`}Qk0A!2g$:]{N*$D+pFVk!8=?{[|N N%rVp}|Ca}');
define('SECURE_AUTH_KEY',  'W|gLOFZc`ch(F(:o^er[87RRL/v/?Rl~Ty30PlX7KGq.*-)jr4haj&-Wz!-|toCw');
define('LOGGED_IN_KEY',    '&yNVmzm2+~aRrJ#i8T):]Yw_0d:s}f5u1Rg=|&p@zLCw+^=pd%}4KEq]v-?]f=<q');
define('NONCE_KEY',        '#rj7.|>n 0Py?`3c,0k-DJu4>Teu-xdv{ep?BMzMM|$dW-ou/+tmb-+8EdS0BOE$');
define('AUTH_SALT',        '_<a~]*mW/5Ovpwj|,H{SvXb%`Pz&Wr=k-.qyJ-6VF@xQ=XoCsMQ_%-FXmS>inCE)');
define('SECURE_AUTH_SALT', '~I|8J,@uD[QP+q-S&P-+R$w972DFBy:&BX8#@u},sRGGP5tCqZ7yssgXi@mI{ven');
define('LOGGED_IN_SALT',   '?mzpIX6Wx761bMvj-uz@6#zic(%X1#Gchf//k~di5JV2b}C1iC~6HH4cqsm$p HQ');
define('NONCE_SALT',       'M7ME@GgxLcjn&C=~$+-E12KFdH*[Q@d:%:Yr|BdQ;});1xF>y3+w|BESsJK;Dj8q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');