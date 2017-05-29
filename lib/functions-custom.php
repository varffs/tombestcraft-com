<?php

// Custom functions (like special queries, etc)

add_action( 'wp_ajax_send_enquiry', 'send_enquiry' );
add_action( 'wp_ajax_nopriv_send_enquiry', 'send_enquiry' );

function send_enquiry() {
  check_ajax_referer('enquiry', 'nonce');

  $to = IGV_get_option('_igv_site_options', '_igv_contact_email');

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

    header('Content-Type: application/json');
    echo json_encode($email);
  } else {
    header('Content-Type: application/json');
    echo json_encode(array('type' => 'error', 'error' => array('type' => 1, 'message' => 'Contact form not configured. Please inform the webmaster')));
  }

  wp_die();
}