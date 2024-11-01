<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Database {
  private $db_version = '2.8.3';

  public static function instance() {
    static $instance = null;
    if ( $instance === null ) {
      $instance = new static();
    }
    return $instance;
  }

  private function __construct() {
  }

  public function run() {
    add_action( 'plugins_loaded', [ $this, 'update_db' ] );
  }

  public function update_db() {
    if ( get_option('speed_metriks_db_version') != $this->db_version ) {
      $this->setup_db();
    }
  }

  public function clean_old_timing_data() {
    global $wpdb;

    $data_table_name = $wpdb->prefix . 'speed_metriks_timing_data';
    $prepare_sql = <<< SQL
DELETE FROM $data_table
WHERE DATE_FORMAT(timestamp, %s) <= %s
SQL;

    $date_format = '%Y-%m-%d';
    $dt = new DateTime();
    $dt->modify('-45 days');
    $delete_threshold = $dt->format('Y-m-d');

    return $wpdb->get_results(
      $wpdb->prepare($prepare_sql, [$date_format, $delete_threshold])
    );
  }

  private function setup_db() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $urls_table_name = $wpdb->prefix . 'speed_metriks_timing_urls';
    $urls_table_sql = <<< EOSQL
CREATE TABLE $urls_table_name (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(2048) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY speed_metriks_url_idx (url(768))
) $charset_collate;
EOSQL;

    $platforms_table_name = $wpdb->prefix . 'speed_metriks_platforms';
    $platforms_table_sql = <<< EOSQL
CREATE TABLE $platforms_table_name (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY speed_metriks_platform_idx (`platform`)
) $charset_collate;
EOSQL;

    $vendors_table_name = $wpdb->prefix . 'speed_metriks_vendors';
    $vendors_table_sql = <<< EOSQL
CREATE TABLE $vendors_table_name (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vendor` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY speed_metriks_vendor_idx (`vendor`)
) $charset_collate;
EOSQL;

    $guids_table_name = $wpdb->prefix . 'speed_metriks_guids';
    $guids_table_sql = <<< EOSQL
CREATE TABLE $guids_table_name (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(48) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY speed_metriks_guid_idx (`guid`)
) $charset_collate;
EOSQL;

    $data_table_name = $wpdb->prefix . 'speed_metriks_timing_data';
    $data_table_sql = <<< EOSQL
CREATE TABLE $data_table_name (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url_id` int(11) unsigned NOT NULL,
  `vendor_id` int(11) unsigned NOT NULL DEFAULT 0,
  `platform_id` int(11) unsigned NOT NULL DEFAULT 0,
  `guid_id` int(11) unsigned NOT NULL DEFAULT 0,
  `t_done` mediumint(9) DEFAULT NULL,
  `ttfb` smallint(6) DEFAULT NULL,
  `download` smallint(6) DEFAULT NULL,
  `dom_ready` mediumint(9) DEFAULT NULL,
  `dom_ready_js` smallint(6) DEFAULT NULL,
  `load_js` smallint(6) DEFAULT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY  (`id`)

) $charset_collate;
EOSQL;

    $nonce_table_name = $wpdb->prefix . 'speed_metriks_timing_nonces';
    $nonce_table_sql = <<< EOSQL
CREATE TABLE $nonce_table_name (
  nonce char(10) NOT NULL,
  timestamp timestamp NOT NULL DEFAULT NOW(),
  url varchar(2048) NOT NULL DEFAULT '',
  UNIQUE KEY speed_metriks_nonce_unique_idx (`nonce`),
  KEY speed_metriks_nonce_delete_idx (timestamp),
  KEY speed_metriks_nonce_query_idx (nonce, url(128), timestamp)
) $charset_collate;
EOSQL;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta([$urls_table_sql, $platforms_table_sql, $vendors_table_sql, $guids_table_sql, $data_table_sql, $nonce_table_sql]);

    update_option( 'speed_metriks_db_version', $this->db_version );
  }
}
