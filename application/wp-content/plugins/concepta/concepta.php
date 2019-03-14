<?php
/*
Plugin Name: Concepta
Plugin URI: https://rsilveira.dev
Description: ...
Version: 0.0.1
Author: Rafael Silveira
Author URI: https://rsilveira.dev
License: MIT
Text Domain: concepta
*/

define('CONCEPTA_DOMAIN', 'concepta');
define('CONCEPTA__PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require_once('vendor/autoload.php');

new \Concepta\Core\Kernel();

