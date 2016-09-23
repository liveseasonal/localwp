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
define('DB_NAME', 'localwp');

/** MySQL database username */
define('DB_USER', 'wpuser');

/** MySQL database password */
define('DB_PASSWORD', 'happytohap23');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'Xf~44~O;RLXc}oF8{0D=_x+D?P-yU{I1cn{>X;@Q 4%dKWMKB[?`Kn>itl&fD>uJ');
define('SECURE_AUTH_KEY',  'mHwS/0:w[.$3QbW8vN]Sk{t/Qjg4g1m*mkdI!L4a`m$oDsep&e0W.Y;(LCj$FnEm');
define('LOGGED_IN_KEY',    'YL^V4wXx:H<oo.*>-M`7i9;czoWbm+M fWE*yKfr=7816Z3XkZxQ5eMJB=}qWoPH');
define('NONCE_KEY',        'L!rg.b@Zk8mF8G(=&M>4TE|J4QCDS!{Kk(V&9TN+>IB]`bGYo[g&Psl29O.dsR()');
define('AUTH_SALT',        'Go-xv6DI)vT@ xY7gP:os%X7rQ@XkV$mn[9[+f3=i#.6M&m#pE{&M<>[xE#g{:WY');
define('SECURE_AUTH_SALT', 't-FO(QbrFp~E+C~v2>VKa5o%+AUg6`KNFT [7$@1v@*^(a?l>Y<Rs%W9&ofX{.v<');
define('LOGGED_IN_SALT',   'T2xN|>ajIz:LCbwtG7@l{a_X^@MmZ<^Lbp@<aEs+w4?ISw=]Oe~`-Mo4,Giu?V<`');
define('NONCE_SALT',       '*<t^zM8 (Ri?LLfh%; 1YIMAgF[!S#{,xsgZ}V4_KJuYolYl`M248<)H%AJTE%v&');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wptest_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
