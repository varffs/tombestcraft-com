<?php

// Custom functions (like special queries, etc)

add_action( 'wp_ajax_send_enquiry', 'send_enquiry' );
add_action( 'wp_ajax_nopriv_send_enquiry', 'send_enquiry' );

function send_enquiry() {
  check_ajax_referer('enquiry', 'nonce');

  $return = array(
    'post' => $_POST,
    'from' => $_POST['data']['from'],
    'copy' => $_POST['data']['copy'],
  );

  header('Content-Type: application/json');
  echo json_encode($return);

  wp_die();
}