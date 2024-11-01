<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Admin_Plots_Menuitem {
  private $page;

  public function __construct($page) {
    $this->page = $page;
  }

  public function init() {
    add_action( 'admin_menu', array($this, 'add_menu_item') );
  }

  public function add_menu_item() {
    add_management_page(
      'SpeedMetriks Plots',
      'SpeedMetriks Plots',
      'manage_options',
      'speed-metriks-plots-page',
      [ $this->page, 'render' ]
    );
  }
}
