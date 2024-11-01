<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_Client {
  private static $home_url;
  private static $rest_route = '/speedmetriks/v1/beacon';

  static function setup() {
    self::$home_url = home_url();
    add_action( 'wp_head', function() {
      $base_url = plugin_dir_url( dirname(__FILE__) );
      $base_path = plugin_dir_path( dirname(__FILE__) );
?>
  <script>
    SpeedMetriks = window.SpeedMetriks || {};
    SpeedMetriks.lib = '<?php echo $base_url; ?>js/boomerang-1.6.0.js';
    SpeedMetriks.beacon_url = '<?php echo self::beacon_url(); ?>';
    SpeedMetriks.security = '<?php echo self::create_nonce(); ?>';
    <?php readfile( $base_path . 'js/speed-metriks-loader.js' ); ?>
  </script>
<?php
    } );
  }

  static function beacon_url() {
    // Check if permalinks are enabled
    if ( get_option('permalink_structure') ) {
      return '/wp-json' . self::$rest_route;
    }

    return '/?rest_route=' . self::$rest_route;
  }

  static function create_nonce() {
    global $wpdb, $wp;

    self::clean_old_nonces();
    $current_url = home_url( add_query_arg([], $wp->request) );

    // Ensure a fqdn in URL
    if ( self::is_relative_url($current_url) ) {
      $current_url = self::$home_url . $current_url;
    }

    if ( substr($current_url, -1) !== '/' ) {
      $current_url .= '/';
    }
    $nonce_table_name = $wpdb->prefix . 'speed_metriks_timing_nonces';
    $result = false;
    $loop_protection = 0;
    $nonce = null;
    while ( !$result && $loop_protection++ < 10 ) {
      $nonce = bin2hex(random_bytes(5));
      $result = $wpdb->insert(
        $nonce_table_name,
        [ 'nonce' => $nonce, 'url' => $current_url ],
        [ '%s', '%s' ]
      );
    }

    return $nonce;
  }

  static function sanitize_nonce($nonce) {
    return substr(preg_replace('|[^a-f0-9]|', '', $nonce), 0, 10);
  }

  static function is_relative_url($url) {
    if (
      substr($url, 0, 7) === 'http://' ||
      substr($url, 0, 8) === 'https://' ||
      substr($url, 0, 2) === '//'
    ) {
      return false;
    }

    return true;
  }

  static function cache_is_enabled() {
    $cache_enabled = false;
    if ( defined('WP_CONTENT_DIR') ) {
      $cache_enabled = file_exists(WP_CONTENT_DIR . '/advanced-cache.php');
    }
    return (bool) apply_filters('speedmetriks_cache_enabled', $cache_enabled);
  }

  static function default_nonce_lifetime() {
    if ( self::cache_is_enabled() ) {
      return 12 * 60; // 12 hours
    }

    return 5;
  }

  static function nonce_lifetime() {
    $default_nonce_lifetime = self::default_nonce_lifetime();
    $nonce_lifetime = apply_filters('speedmetriks_nonce_lifetime', $default_nonce_lifetime);

    // Ensure that we have a sane value for $nonce_lifetime
    if ( !is_numeric($nonce_lifetime) || $nonce_lifetime <= 0 ) {
      // TODO throw some kind of error/warning
      $nonce_lifetime = $default_nonce_lifetime;
    }
    return (int) $nonce_lifetime;
  }

  static function check_nonce($nonce, $url) {
    global $wpdb;

    $nonce_table_name = $wpdb->prefix . 'speed_metriks_timing_nonces';
    $sql = $wpdb->prepare(
      "SELECT COUNT(*) FROM {$nonce_table_name} WHERE nonce = %s AND url = %s AND timestamp >= NOW() - INTERVAL %d MINUTE",
      [ $nonce, $url, self::nonce_lifetime() ]
    );
    $count = $wpdb->get_var($sql);
    return ((int) $count) === 1;
  }

  static function clean_old_nonces() {
    global $wpdb;

    $nonce_table_name = $wpdb->prefix . 'speed_metriks_timing_nonces';
    $wpdb->query(
      $wpdb->prepare(
        "DELETE FROM {$nonce_table_name} WHERE timestamp < NOW() - INTERVAL %d MINUTE",
        [ self::nonce_lifetime() ]
      )
    );
  }
}
