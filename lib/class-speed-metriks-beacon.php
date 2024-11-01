<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Beacon {
  private $request;
  private $url;
  private $vendor;
  private $platform;

  function __construct(WP_REST_Request $request) {
    $this->request = $request;
    $this->sanitize_request();
  }

  function sanitize_request() {
    $this->url = strip_tags(
      stripslashes(
        filter_var($this->request['u'], FILTER_VALIDATE_URL)
      )
    );
    $this->vendor = sanitize_text_field($this->request['ua_vnd']);
    $this->platform = sanitize_text_field($this->request['ua_plt']);
    $this->guid = sanitize_text_field($_COOKIE['GUID']);
  }

  function save() {
    if ( !$this->ignore_nonces() && !$this->valid_nonce() ) {
      return "Invalid security token";
    }

    $url_id = $this->get_url_id();
    $vendor_id = $this->get_vendor_id();
    $platform_id = $this->get_platform_id();
    $guid_id = $this->get_guid_id();

    global $wpdb;
    $data_table = $wpdb->prefix . 'speed_metriks_timing_data';
    $timing_data = [
      'url_id' => $url_id,
      'vendor_id' => $vendor_id,
      'platform_id' => $platform_id,
      'guid_id' => $guid_id,
      't_done' => intval($this->request['t_done']),
      'ttfb' => intval($this->request['nt_res_st']) - intval($this->request['nt_req_st']),
      'download' => intval($this->request['nt_res_end']) - $this->request['nt_res_st'],
      'dom_ready' => intval($this->request['nt_domcontloaded_st']) - intval($this->request['nt_nav_st']),
      'dom_ready_js' => intval($this->request['nt_domcontloaded_end']) - intval($this->request['nt_domcontloaded_st']),
      'load_js' => intval($this->request['nt_load_end']) - intval($this->request['nt_load_st']),
    ];
    $wpdb->insert(
      $data_table,
      $timing_data,
      [
        '%d', // url_id
        '%d', // vendor_id
        '%d', // platform_id
        '%d', // guid_id
        '%d', // t_done
        '%d', // ttfb
        '%d', // download
        '%d', // dom_ready
        '%d', // dom_ready_js
        '%d', // load_js
      ]
    );
  }

  private function ignore_nonces() {
    return (bool) apply_filters('speedmetriks_ignore_nonces', false);
  }

  private function valid_nonce() {
    $nonce = SpeedMetriks_Client::sanitize_nonce($this->request['speed_metriks_s']);
    return SpeedMetriks_Client::check_nonce($nonce, $this->url) === true;
  }

  private function get_url_id() {
    global $wpdb;
    $url_table = $wpdb->prefix . 'speed_metriks_timing_urls';

    $url_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT id FROM {$url_table} WHERE url = %s",
        $this->url
      )
    );
    if ( !$url_id ) {
      $wpdb->insert(
        $url_table,
        [ 'url' => $this->url ],
        [ '%s' ]
      );
      $url_id = $wpdb->insert_id;
    }

    return $url_id;
  }

  private function get_vendor_id() {
    global $wpdb;
    $vendor_table = $wpdb->prefix . 'speed_metriks_vendors';
    $vendor_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT id FROM {$vendor_table} WHERE vendor = %s",
        $this->vendor
      )
    );
    if ( !$vendor_id ) {
      $wpdb->insert(
        $vendor_table,
        [ 'vendor' => $this->vendor ],
        [ '%s' ]
      );
      $vendor_id = $wpdb->insert_id;
    }
    return $vendor_id;
  }

  private function get_platform_id() {
    global $wpdb;
    $platform_table = $wpdb->prefix . 'speed_metriks_platforms';
    $platform_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT id FROM {$platform_table} WHERE platform = %s",
        $this->platform
      )
    );
    if ( !$platform_id ) {
      $wpdb->insert(
        $platform_table,
        [ 'platform' => $this->platform ],
        [ '%s' ]
      );
      $platform_id = $wpdb->insert_id;
    }
    return $platform_id;
  }

  private function get_guid_id() {
    global $wpdb;
    $guid_table = $wpdb->prefix . 'speed_metriks_guids';
    $guid_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT id FROM {$guid_table} WHERE guid = %s",
        $this->guid
      )
    );
    if ( !$guid_id ) {
      $wpdb->insert(
        $guid_table,
        [ 'guid' => $this->guid ],
        [ '%s' ]
      );
      $guid_id = $wpdb->insert_id;
    }
    return $guid_id;
  }
}

