<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('MYSQL_DATABASE'));

/** MySQL database username */
define('DB_USER', getenv('MYSQL_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('MYSQL_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('MYSQL_HOST'));

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Jf?qKu$1TNQVPX&VXVs5ol+bopM+;6s#?gq)hTEjQ1M5]XEF{yaEGe7-Hg?7#itZ');
define('SECURE_AUTH_KEY',  '@!gV;UOC8wW.+[Jr{<_[}y0%]%.sgL#>K=DcgS-X1Wc(LqC/++04%dUW~We]MB+O');
define('LOGGED_IN_KEY',    'b<{*dnCm[;^42/x5UoKr[WS3JmpxmSmT#])Tpv3mT)O(6AQ1e4,se!/W-F=*uZ>,');
define('NONCE_KEY',        'L/vf=vJoR8Zck3H0_ RP4~;o9_Z$s~$TH[q(E{Xc>L5Bq#kX|JH7AlO0MJYz4y|]');
define('AUTH_SALT',        'Oq_.s& f0}.LY A&3XD*<EQTl[x)24Q]Z+i(K2!=F&,{KpSo^ap]+WXwHcZp7Hr7');
define('SECURE_AUTH_SALT', ')])?,nsa4I)[Y[cT6t769n.as7qXdJ`T`74b=rQc{.p3,,nmJE}(>qAXV#J0VEbu');
define('LOGGED_IN_SALT',   '(Fh9];0@[~7EDzRGZ,D[=h@QN0w^*~oKA$w0~{*/p}OO tv(Ve!N(%>bkb#N2PEO');
define('NONCE_SALT',       'y `N,8ucA][Eay.OpJ*ZQ(DB6lA*`@q_y<T?X+~|&afKSBCprmr->$fpxz/|{}c#');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'conceptainc_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

define('WP_DEBUG_LOG', true);

define('WP_DEBUG_DISPLAY', false);
/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
