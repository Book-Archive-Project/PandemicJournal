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
define( 'DB_NAME', "pandemicjournal" );

/** MySQL database username */
define( 'DB_USER', "root" );

/** MySQL database password */
define( 'DB_PASSWORD', "" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'e<eK`_3*,+qeiuW__9~}1|LF-(_.|Z9|Bb}8$w^S44*pi.>?M(^<`s@oj8tL1 |U' );
define( 'SECURE_AUTH_KEY',  'Y!j^><-3fe),a F|%]6o =KuI;1mOXZg(6|9}ELJJCsYt5AE2Vzc1X~fc0Nl^~GX' );
define( 'LOGGED_IN_KEY',    '7:|/C)1MEZba7d*.h&`7$mo87m#m-q)!cAPjwrBRp~KK:@+HQutNL2{+vh+0<6YL' );
define( 'NONCE_KEY',        'l<V {YBHe;FO]b7d4!D;!7fm:;AY<6HKjNTxK0@#}0UPo}8Np}g]yV~|||_Ft=vm' );
define( 'AUTH_SALT',        '&a:f+D(H8Q#7,zT.X,q1)sEy^HooI^I1gPr9S?Cnp$|w P[GWZJ(`b&-UD;kJq-z' );
define( 'SECURE_AUTH_SALT', 'Z4TxL;Ozq633EnID=.X+qwccS_p~g8h&v>h6gC4Wq>g;x{jg4!/$;LDltDY Q<O#' );
define( 'LOGGED_IN_SALT',   'Cm^}4_@o<-w^ExNk8:BPe7^`aqsNJZ%ix]r~z9]}aWi}WP7l[0n4dwg#E%k=,#C(' );
define( 'NONCE_SALT',       '?yeg<PqaQ1N+upQ,U.VS3lAh_r=lRxZ~>Bp$ZH8&PE(jW_W=~B1N:qs-0^3}xk5=' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pbook';

    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', true );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
