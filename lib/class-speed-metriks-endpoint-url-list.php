<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Endpoint_UrlList {
  static function setup() {
    register_rest_route( 'speedmetriks/v1', '/url-list', array(
      'methods' => 'GET',
      'callback' => array(self::class, 'rest_callback'),
    ) );
  }

  static function rest_callback(WP_REST_Request $request) {
    $url_list = new SpeedMetriks_UrlList($request);
    return $url_list->fetch();
  }
}

