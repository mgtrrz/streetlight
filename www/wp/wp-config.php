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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'default_wp');

/** MySQL database password */
define('DB_PASSWORD', '7c6IFlW8OQzhu6q');

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
define('AUTH_KEY',         'mAI8^j]P8bJF.yv^j5#bq^e#G&mX0=QR&Xabv8G8cwp.<R(j.=tz]=@@nQjOCWCB');
define('SECURE_AUTH_KEY',  '3`3/mCJ^_eV}{B?L0Sutjhin$`.lMDP04),g&X6]E;hNMp2t>6om%b!aJ>X~?hAC');
define('LOGGED_IN_KEY',    'X/jBS@,RWYGT~L_FYFj&F{}[C?biF~SSa52EKTeNY~|`N/`uK~6jqMf4TOgejLe0');
define('NONCE_KEY',        'G_>K~dT&[7fo1d,O/>Jmc44w[Ortu&>5JTx}}{b#+=z3tzn)zo$?F_KNQYu{B0!G');
define('AUTH_SALT',        'f`%<G>ljB?,@uOjhtMY6=ewYyTsUwv[-$8%JGt4vo:et(vEh}ju,6pnXw*yf %8g');
define('SECURE_AUTH_SALT', 'Gyx1pmoSEPl8=WNMfBJq*]jH-j8(|.CrZ}*b0-]osEyyB~qxA3Yf,,sFcF{qLaFN');
define('LOGGED_IN_SALT',   '~~mdA.}N{v,7V0rWAcC2/W@v5>RZ5<,B,VprVxug=>YYl^^0CXkg*J[wK(bm7-kH');
define('NONCE_SALT',       '7~}]4>jefX(=7.i@bYg0S|l;YuyH]~kowdB:u8{I:^/WT,*kt^S<3y$)$@1&7zXc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
