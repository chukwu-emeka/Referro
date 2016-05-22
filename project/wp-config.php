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
define('DB_NAME', 'project_agape');

/** MySQL database username */
define('DB_USER', 'ProjectAgape');

/** MySQL database password */
define('DB_PASSWORD', '1234');

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
define('AUTH_KEY',         '|DV~)m5@>(91<[S(3KeO.i|ISG!?$2zQeRl@~Ov*[LSqfHF#`+@8<W^pJ[Wu;o0C');
define('SECURE_AUTH_KEY',  '7w-9WK,sol= s+`4j#OE%hJ19c.y#o!S;stHX[HWPuG6o<#(xz@{IIpOw ?L;w#M');
define('LOGGED_IN_KEY',    'U0N^.[|Ho*R3%K!.^Io~lB?|,H3eg0[f04Y%Rj8a7,`qr.,yEpE8|IhJw7_I)ds ');
define('NONCE_KEY',        '<F6R%AX&_Es=><-DHhU?bVfB6GZffCy2&S}`o6:*)~km%uzKn|6^*1|XM D]3b.m');
define('AUTH_SALT',        'c[/hXA#yaP!E3?)@FEm4,Wca%fo1LAX*VJ%~@hu$ZOA5l.rp|R`Ds9Mg9mrl3~MD');
define('SECURE_AUTH_SALT', 'Vpp{5h]!c&bKTdy> Kfkw,BX+|hQ*=wt|}Qa]6Y9^UR;fk /M8#eyL!Ck~ZU>c,e');
define('LOGGED_IN_SALT',   'giH^0,N9!W`xU_Xe<~+vM3&*:U?DDwO&Du(Ezn,F2@>Kc~mr7KZC9aG8E#j>W}fH');
define('NONCE_SALT',       '3IS;@C-l7Hh< `+n{O5j)ab_zU{QiW6OoyqmrI~FpR~ta<.m`IO:S)@$B)%xxa#|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_pa';

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
