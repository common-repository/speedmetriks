<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Activator {
  public static function activate() {
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-database.php';
    SpeedMetriks_Database::instance()->update_db();
  }
}
