<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Admin_Page {

  public function setup() {
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
  }

  // Null function for consistent interface
  public function enqueue_scripts() {
  }
}
