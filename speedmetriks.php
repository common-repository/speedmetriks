<?php
/*
 * Plugin Name: SpeedMetriks
 * Plugin URI: https://speedmetriks.com
 * Description: Real User Monitoring for WordPress
 * Version: 1.4.4
 * Author: Matt Vanderpol
 * Author URI: https://mattvanderpol.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2019 Red Madrone Solutions, Inc.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function activate_speed_metriks() {
  require_once plugin_dir_path(__FILE__) . 'lib/class-speed-metriks-activator.php';
  SpeedMetriks_Activator::activate();
}

require_once plugin_dir_path(__FILE__) . 'lib/class-speed-metriks-requirements-check.php';
$speed_metriks_requirements_check = new SpeedMetriks_Requirements_Check( array(
  'title' => 'SpeedMetriks',
  'php' => '7.0',
  'wp' => '4.7',
  'file' => __FILE__,
) );

if ( $speed_metriks_requirements_check->passes() ) {
  register_activation_hook(__FILE__, 'activate_speed_metriks');

  require plugin_dir_path(__FILE__) . 'lib/class-speed-metriks.php';

  function run_speed_metriks() {
    $plugin = new SpeedMetriks();
    $plugin->run();
  }
  run_speed_metriks();
}
