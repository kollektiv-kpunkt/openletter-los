<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/kollektiv-kpunkt/openletter-los
 * @since             1.0.0
 * @package           Openletter_Los
 *
 * @wordpress-plugin
 * Plugin Name:       Openletter LOS
 * Plugin URI:        https://github.com/kollektiv-kpunkt/openletter-los
 * Description:       Plugin for openletter by lesbenorganisation Schweiz
 * Version:           1.0.0
 * Author:            Timothy@K.
 * Author URI:        https://kpunkt.ch/
 * GitHub Plugin URI: https://github.com/kollektiv-kpunkt/openletter-los
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       openletter-los
*/

require_once(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

global $lang;
$lang = json_decode(file_get_contents(__DIR__ . "/i18n/{$_ENV["LANG"]}.json"), true);

function ol_los_scripts() {
    wp_enqueue_style( 'ol-los-fa', plugin_dir_url(__FILE__) . "lib/font-awesome/css/font-awesome.min.css", [], "1.0.0" );
    wp_enqueue_style( 'ol-los-theme', plugin_dir_url(__FILE__) . 'dist/theme.css', [], "1.0.0" );
    wp_enqueue_style( 'ol-los-bundle', plugin_dir_url(__FILE__) . 'dist/style.css', [], "1.0.0" );
    wp_enqueue_script( 'ol-los-bundle', plugin_dir_url(__FILE__) . 'dist/app.js', array(), "1.0.0", true );
}
add_action( 'wp_enqueue_scripts', 'ol_los_scripts' );

function ol_los_shortcode($atts) {
    ob_start();
    include(__DIR__ . "/templates/openletter.php");
    return ob_get_clean();
}
add_shortcode('los-openletter', 'ol_los_shortcode');