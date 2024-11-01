<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Endpoints {
  function __construct() {
    $this->load_dependencies();
  }

  private function load_dependencies() {
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-endpoint-beacon.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-beacon.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-endpoint-graph-data.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-graph-data.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-endpoint-url-list.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-url-list.php';
  }

  function setupAdmin() {
    add_action('rest_api_init', array('SpeedMetriks_Endpoint_GraphData', 'setup'));
    add_action('rest_api_init', array('SpeedMetriks_Endpoint_UrlList', 'setup'));
  }

  function setupFrontend() {
    add_action('rest_api_init', array('SpeedMetriks_Endpoint_Beacon', 'setup'));
  }
}
