<?php

// Custom functions (like special queries, etc)

add_action( 'wp_ajax_send_enquiry', 'send_enquiry' );
add_action( 'wp_ajax_nopriv_send_enquiry', 'send_enquiry' );

function send_enquiry() {
  check_ajax_referer('enquiry', 'nonce');

  $to = IGV_get_option('_igv_site_options', '_igv_contact_email');

  header('Content-Type: application/json');

  if ($to) {
    $product = sanitize_text_field($_POST['data']['product']);
    $from = sanitize_email($_POST['data']['from']);
    $copy = sanitize_textarea_field($_POST['data']['copy']);

    $title   = 'Craft Enquiry: ' . $product;
    $headers = array('From: ' . $from . ' <' . $from . '>');
    $message = '<h2>New message about ' . $product . '</h2><h3>This is what ' . $from . ' had to say:</h3>' . $copy;

    //Send the email
    add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
    $email = wp_mail($to, $title, $message, $headers);
    remove_filter('wp_mail_content_type', 'set_html_content_type');

    if ($email) {
      echo json_encode(array('type' => 'success'));
    } else {
      echo json_encode(array('type' => 'error', 'error' => array('type' => 2, 'message' => 'Message not sent. Email sending failed. Please inform the webmaster')));
    }

  } else {
    echo json_encode(array('type' => 'error', 'error' => array('type' => 1, 'message' => 'Contact form not configured. Message not sent. Please inform the webmaster')));
  }

  wp_die();
}