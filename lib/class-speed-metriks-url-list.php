<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_UrlList {
  private $request;

  function __construct(WP_REST_Request $request) {
    $this->request = $request;
  }

  function fetch() {
    global $wpdb;
    $url_table = $wpdb->prefix . 'speed_metriks_timing_urls';
    $sql = "SELECT url FROM $url_table ORDER BY url ASC";
    $results = $wpdb->get_results($sql, ARRAY_N);

    return array_map(function($u) { return $u[0]; }, $results);
  }
}

