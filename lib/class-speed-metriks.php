<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks {
  public function __construct() {
    $this->load_dependencies();
    SpeedMetriks_Client::setup();
  }

  private function load_dependencies() {
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-client.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-database.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-endpoints.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-cron.php';

    if ( is_admin() ) {
      require_once plugin_dir_path(__DIR__) . 'admin/class-speed-metriks-admin.php';
    }
  }

  public function run() {
    SpeedMetriks_Database::instance()->update_db();
    SpeedMetriks_Cron::check_cron();
    $endpoints = new SpeedMetriks_Endpoints();
    if ( is_admin() ) {
      $admin = new SpeedMetriks_Admin();
      $admin->setup();
    }
    $endpoints->setupAdmin();
    $endpoints->setupFrontend();
  }
}
