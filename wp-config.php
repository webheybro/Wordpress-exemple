<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wp_exemple' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ZNT0i.-[H>{>gpM%.rlXQnI}aa[xu]hN*S ,Eq,0p|w5zAu]e[of=HatGtaiqd,I' );
define( 'SECURE_AUTH_KEY',  '?H&OzyXnQs>Mm+0sbo|,WRE os5i9=hjlPFZgPwbBq~$bf/V,&r>vtlGaF:vZ{@j' );
define( 'LOGGED_IN_KEY',    '[zr(_XB-3y+dI4MEp Dh^pF}-p9QH8j!BqhuSCtdSd_{kU,l<g,{q=({rY[{vq3;' );
define( 'NONCE_KEY',        '[_QowBoU9rt$zpimp2a43Uo9ff]SYvZx$Ezmy9UX6g5Xh^uT_3I(k}cbw-#p]ohD' );
define( 'AUTH_SALT',        'U)sHZwu.~QN|_u5!5)e(:%[xi{;? qI>.sSE]CXn3v^R8AWc)gCQ;gX|1b2C??LQ' );
define( 'SECURE_AUTH_SALT', 'skANlcAy>Ut%c+V/IZX.GrjZu-K=OW* o[vYW74d@q}-=:pUt|21Xivb9R|?qQPX' );
define( 'LOGGED_IN_SALT',   '.nWc-QD2Jgdx4k7&Yg]2LT, $7  u[_;<>Jk;Y`1!,Y)EnD4z$Kcf03cN,90*EH6' );
define( 'NONCE_SALT',       't?fgu67.}l,HT@l6TgOO)T3(p[o634U3K,,$j&3kj-;[``*?iW0zpWp})paAMbeE' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
