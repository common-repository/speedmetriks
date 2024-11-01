<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Endpoint_GraphData {
  static function setup() {
    register_rest_route( 'speedmetriks/v1', '/graph-data', array(
      'methods' => 'GET',
      'callback' => array(self::class, 'rest_callback'),
    ) );
  }

  static function rest_callback(WP_REST_Request $request) {
    $graph_data = new SpeedMetriks_GraphData($request);
    return $graph_data->fetch();
  }
}
