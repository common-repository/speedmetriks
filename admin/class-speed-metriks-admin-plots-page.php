<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Admin_Plots_Page extends SpeedMetriks_Admin_Page {

  public function render() {
    include_once('views/plot-page.php');
  }

  public function enqueue_scripts() {
    wp_register_script( 'speed_metriks_app_js', plugin_dir_url(__DIR__) . 'dist/main.js', [], '1.4', true );
    $js_params = [
      'env' => 'dev',
      'security' => wp_create_nonce('wp_rest'),
      'defaultUrl' => site_url() . '/',
      'pluginScriptPrefix' => '/wp-json/',
    ];
    wp_localize_script('speed_metriks_app_js', 'SpeedMetriksSetup', $js_params);
    wp_enqueue_script('speed_metriks_app_js');
  }
}
