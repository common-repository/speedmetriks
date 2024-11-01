<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Endpoint_Beacon {
  static function setup() {
    register_rest_route( 'speedmetriks/v1', '/beacon', array(
      'methods' => 'POST',
      'callback' => array(self::class, 'rest_callback'),
    ) );
  }

  static function rest_callback(WP_REST_Request $request) {
    if (self::bad_request($request)) {
      return null;
    }

    $beacon = new SpeedMetriks_Beacon($request);
    return $beacon->save();
  }

  private static function bad_request(WP_REST_Request $request) {
    if ( !isset($request['nt_res_st']) || !isset($request['nt_req_st']) ) {
      return true;
    }

    $ttfb = intval($request['nt_res_st']) - intval($request['nt_req_st']);
    return $ttfb === 0;
  }
}

