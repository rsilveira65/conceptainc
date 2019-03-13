<?php
/*
Plugin Name: Conceptainc
Plugin URI: https://rsilveira.dev
Description: Conceptainc plugin.
Version: 0.0.1
Author: Rafael Silveira
Author URI: https://rsilveira.dev
*/

define('CONCEPTAINC__VERSION', '0.0.1' );
define('CONCEPTAINC__PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('CONCEPTAINC__PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require_once(CONCEPTAINC__PLUGIN_DIR . 'API/ConceptaincAPICaller.php');
require_once(CONCEPTAINC__PLUGIN_DIR . 'Shortcode/ConceptaincShortcodeRender.php');
require_once(CONCEPTAINC__PLUGIN_DIR . 'Shortcode/ConceptaincShortcode.php');

add_action('init', ['ConceptaincAPICaller', 'init'], 10);
