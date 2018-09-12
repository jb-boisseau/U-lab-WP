<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wpulab');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' z-)E#cJ/=6PCj[8iF_Ty94XRZMj_e^uU1xyq;qs5% 5t:M~fTVOEf)x7m=V@oox');
define('SECURE_AUTH_KEY',  'rV.fF=S}GbqDIt?u/y#LB;A,n<WsLSP8t,TPT#3T|vk:G+nN)%7p6FH%bIL}lpO#');
define('LOGGED_IN_KEY',    '6zT@n_1{zw}s?R%^[9$71>+V1*M!<Nl54e[%. Vz!ne(jlZFCd*H[`./MJW?G]CK');
define('NONCE_KEY',        '`07ZiSns1Y~/>Y-l_&ho?%Q|Io6Q;hShB8>*kGO|:q(t#_+:|z-)6)CuA< /otZX');
define('AUTH_SALT',        '{zKkzyI3pKU<Ai29#USsZE[,hvR5b2A^DpIu$O]&d| |KW8rdIEZxbtC_|$.&~p ');
define('SECURE_AUTH_SALT', '7lp)J[B4|9^XptYunD->-;_-BJ]W#A`{Ec-7Ot])&9Y A,KhH!7E n#.8ga7.P) ');
define('LOGGED_IN_SALT',   '2[-;!mU;w~81~h@KwOkFK/{wLqG$3RS,Hqp19]iBVEb0W!*0@5ztgZXGfOW[ RU!');
define('NONCE_SALT',       'Eyd~; 99(EXn6X?>Dg[mQ)sE$/o&v[QJ8{nx$)i.2WUUdp%4+4x|3mw[NB^#N=@C');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');