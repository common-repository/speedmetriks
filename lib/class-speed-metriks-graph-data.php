<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpeedMetriks_GraphData {
  private $request;
  private $url;
  private $start_date;
  private $end_date;

  private $dom_ready_limit = 10;

  function __construct(WP_REST_Request $request) {
    $this->request = $request;
    $this->sanitize_request();
  }

  private function sanitize_request() {
    $this->url = strip_tags(
      stripslashes(
        filter_var($this->request['url'], FILTER_VALIDATE_URL)
      )
    );
    $this->start_date = $this->request['start_date'] ?
      date('Y-m-d', strtotime($this->request['start_date'])) :
      date('Y-m-d', strtotime('-1 week'));
    $this->end_date = $this->request['end_date'] ?
      date('Y-m-d', strtotime($this->request['end_date'])) :
      date('Y-m-d');
  }

  private function dom_ready_clause() {
    return '(floor(td.dom_ready/100.0)*100)/1000.0 AS dom_ready';
  }

  private function build_dom_ready_sql_query() {
    global $wpdb;

    $date_format = '%Y-%m-%d';
    $start_date_constraint = $wpdb->prepare(' AND DATE_FORMAT(td.timestamp, %s) >= %s', [$date_format, $this->start_date]);
    $end_date_constraint = $wpdb->prepare(' AND DATE_FORMAT(td.timestamp, %s) <= %s', [$date_format, $this->end_date]);

    $data_table = $wpdb->prefix . 'speed_metriks_timing_data';
    $url_table = $wpdb->prefix . 'speed_metriks_timing_urls';
    $dom_ready_clause = $this->dom_ready_clause();
    $prepare_sql = <<< SQL
SELECT $dom_ready_clause, count(*) AS count
FROM $data_table td
  JOIN $url_table tu ON td.url_id = tu.id
WHERE tu.url = %s
  AND td.dom_ready < %d
SQL;
    $group_and_order_clauses = ' GROUP BY 1 ORDER BY 1';

    return $wpdb->prepare($prepare_sql, [$this->url, $this->dom_ready_limit * 1000]) . $start_date_constraint . $end_date_constraint . $group_and_order_clauses;
  }

  private function build_bounces_sql_query() {
    global $wpdb;

    $date_format = '%Y-%m-%d';
    $start_date_constraint = $wpdb->prepare(' AND DATE_FORMAT(timestamp, %s) >= %s', [$date_format, $this->start_date]);
    $end_date_constraint = $wpdb->prepare(' AND DATE_FORMAT(timestamp, %s) <= %s', [$date_format, $this->end_date]);

    $data_table = $wpdb->prefix . 'speed_metriks_timing_data';
    $url_table = $wpdb->prefix . 'speed_metriks_timing_urls';
    $sub_query = <<< SUBQUERY_SQL
SELECT guid_id
FROM $data_table
WHERE 1=1 $start_date_constraint $end_date_constraint
GROUP BY guid_id
HAVING COUNT(*) = 1
SUBQUERY_SQL;

    $dom_ready_clause = $this->dom_ready_clause();
    $prepare_sql = <<< SQL
SELECT $dom_ready_clause, count(*) AS bounces
FROM $data_table td
	JOIN $url_table tu ON td.url_id = tu.id
WHERE tu.url = %s
  AND td.dom_ready < %d
SQL;

    return $wpdb->prepare($prepare_sql, [$this->url, $this->dom_ready_limit * 1000]) . ' AND td.guid_id IN ( ' . $sub_query . ' ) GROUP BY 1 ORDER BY 1';
  }

  private function build_visits_sql_query() {
    global $wpdb;

    $date_format = '%Y-%m-%d';
    $start_date_constraint = $wpdb->prepare(' AND DATE_FORMAT(td.timestamp, %s) >= %s', [$date_format, $this->start_date]);
    $end_date_constraint = $wpdb->prepare(' AND DATE_FORMAT(td.timestamp, %s) <= %s', [$date_format, $this->end_date]);

    $data_table = $wpdb->prefix . 'speed_metriks_timing_data';
    $url_table = $wpdb->prefix . 'speed_metriks_timing_urls';
    $dom_ready_clause = $this->dom_ready_clause();
    $prepare_sql = <<< SQL
SELECT $dom_ready_clause, count(*) AS visits
FROM $data_table td
  JOIN $url_table tu ON td.url_id = tu.id
WHERE tu.url = %s
  AND td.dom_ready < %d
SQL;

    return $wpdb->prepare($prepare_sql, [$this->url, $this->dom_ready_limit * 1000]) . $start_date_constraint . $end_date_constraint . ' GROUP BY 1 ORDER BY 1';
  }

  private function build_dom_ready_trace() {
    global $wpdb;

    // Pre-setup data with zeros
    $data = [];
    for ($i = 0; $i < ($this->dom_ready_limit * 5); $i++) {
      $key = sprintf('%0.2f', $i*0.2);
      $data[$key] = 0;
    }

    // Populate data
    $results = $wpdb->get_results( $this->build_dom_ready_sql_query() );
    foreach ($results as $result) {
      $data[sprintf('%0.2f', $result->dom_ready)] = intval($result->count);
    }

    $trace = [
      'x' => array_keys($data),
      'y' => array_values($data),
      'type' => 'bar',
      'name' => 'onDOMReady'
    ];
    return $trace;
  }

  private function build_bounce_rate_trace() {
    global $wpdb;
    $bounce_results = $wpdb->get_results( $this->build_bounces_sql_query() );
    $all_results = $wpdb->get_results( $this->build_visits_sql_query() );

    $data = [];
    foreach ($bounce_results as $result) {
      $data[sprintf('%0.2f', $result->dom_ready)] = $result->bounces;
    }

    foreach ($all_results as $result) {
      $key = sprintf('%0.2f', $result->dom_ready);
      if ( isset($data[$key]) ) {
        $data[$key] = $data[$key] / $result->visits;
      }
    }

    $trace = [
      'x' => array_keys($data),
      'y' => array_values($data),
      'yaxis' => 'y2',
      'type' => 'scatter',
      'name' => 'Bounce Rate'
    ];
    return $trace;
  }

  function fetch() {
    return [
      $this->build_dom_ready_trace(),
      $this->build_bounce_rate_trace()
    ];
  }
}
