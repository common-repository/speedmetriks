<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Cron {
  private static $hook_name = 'speedmetriks_clean_data';

  public static function check_cron() {
    if ( !wp_next_scheduled(static::$hook_name) ) {
      wp_schedule_event(time(), 'daily', static::$hook_name);
    }

    add_action(static::$hook_name, ['SpeedMetriks_Cron', 'clean_old_data']);
  }

  public static function clean_old_data() {
    SpeedMetriks_Database::instance()->clean_old_timing_data();
  }
}
