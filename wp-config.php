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
define('DB_NAME', 'awesome');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'h,w+8<%1ACKkY<0Fo>W)_1]w%9 ^1mQ;N{<M<|w5x^H@Zb<M#aW^w9fzi-qJ}k3L');
define('SECURE_AUTH_KEY',  '}+I }Em>2o(rkWI*V`S6CwagipH[p^{jgv^PTY[*x:K:M+/]<f`zd|(23_qut82v');
define('LOGGED_IN_KEY',    '*E@dmN#ji+l]~G3scKj+>w|N:/E};._?.g|[q!*INwbj_,&3WHb[{w/KGN2,k9C;');
define('NONCE_KEY',        'gMGo.WwzE>rC?1Hef3fL^B],J,PIiWNJQAt@5.cP5.]+5Ot<ZkPYQ`/6}a}<nzJr');
define('AUTH_SALT',        'SCMD90=AOe^>}MLhan@qB^ok-^31Mj_-pL[$]#(pSs?;bPIq-R{2/0>Ad{alwzF,');
define('SECURE_AUTH_SALT', '~{E9c5z)NS4L_]JW)[WFd@N).S $*(|R3A^P.v.=A)ptI#(z7e.2>S](pG=+e&9k');
define('LOGGED_IN_SALT',   'CPtdn$4gur#Fz+H7,cyuVQ0|%L`8TZFEg )/upjm6@]FYyf+ F@MT_[R?|=T{9zT');
define('NONCE_SALT',       'VUIe-yKD}]XYG]>eRZ gDro30+59,/vqsjY`}*6_2kY4 OzUA+b-$:zobveh&#}`');

/**#@-*/

define('WP_HOME','http://localhost:8888/awesome');
define('WP_SITEURL','http://localhost:8888/awesome');

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

@define('WP_MEMORY_LIMIT', '256M');