<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Admin {

  public function __construct() {
    $this->load_dependencies();
  }

  public function setup() {
    $page = new SpeedMetriks_Admin_Plots_Page();
    $page->setup();
    $menuitem = new SpeedMetriks_Admin_Plots_Menuitem($page);
    $menuitem->init();
  }

  private function load_dependencies() {
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-admin-page.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-admin-plots-menuitem.php';
    require_once plugin_dir_path(__FILE__) . 'class-speed-metriks-admin-plots-page.php';
  }

}
