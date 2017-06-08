<?php
// SITE OPTIONS
$prefix = '_igv_';
$suffix = '_options';

$page_key = $prefix . 'site' . $suffix;
$page_title = 'Site Options';
$metabox = array(
  'id'         => $page_key, //id used as tab page slug, must be unique
  'title'      => $page_title,
  'show_on'    => array( 'key' => 'options-page', 'value' => array( $page_key ), ), //value must be same as id
  'show_names' => true,
  'fields'     => array(
    // EMAIL

    array(
      'name' => __( 'Contact email', 'cmb2' ),
      'desc' => __( '', 'cmb2' ),
      'id'   => $prefix . 'contact_title',
      'type' => 'title',
    ),
    array(
      'name' => __( 'Set your contact email', 'IGV' ),
      'desc' => __( 'this is where enquiries on the website will be sent', 'IGV' ),
      'id'   => $prefix . 'contact_email',
      'type' => 'text_email',
    ),

    array(
      'name' => __( 'Social Media', 'cmb2' ),
      'desc' => __( 'urls and accounts for different social media platforms. For use in menus and metadata', 'cmb2' ),
      'id'   => $prefix . 'socialmedia_title',
      'type' => 'title',
    ),
    array(
      'name' => __( 'Facebook Page URL', 'IGV' ),
      'desc' => __( '', 'IGV' ),
      'id'   => $prefix . 'socialmedia_facebook_url',
      'type' => 'text',
    ),
    array(
      'name' => __( 'Twitter Account Handle', 'IGV' ),
      'desc' => __( '', 'IGV' ),
      'id'   => $prefix . 'socialmedia_twitter',
      'type' => 'text',
    ),
    array(
      'name' => __( 'Instagram Account Handle', 'IGV' ),
      'desc' => __( '', 'IGV' ),
      'id'   => $prefix . 'socialmedia_instagram',
      'type' => 'text',
    ),

    // METADATA OPTIONS

    array(
      'name' => __( 'Metadata options', 'cmb2' ),
      'desc' => __( 'Settings relating to open graph, facebook and twitter sharing, and other social media metadata', 'cmb2' ),
      'id'   => $prefix . 'og_title',
      'type' => 'title',
    ),
    array(
      'name' => __( 'Open Graph default image', 'IGV' ),
      'desc' => __( 'primarily displayed on Facebook, but other locations as well', 'IGV' ),
      'id'   => $prefix . 'og_image',
      'type' => 'file',
    ),
    array(
      'name' => __( 'Logo for SEO results', 'IGV' ),
      'desc' => __( '(options) ', 'IGV' ),
      'id'   => $prefix . 'metadata_logo',
      'type' => 'file',
    ),
    array(
      'name' => __( 'Facebook App ID', 'IGV' ),
      'desc' => __( '(optional)', 'IGV' ),
      'id'   => $prefix . 'og_fb_app_id',
      'type' => 'text',
    ),

    // BOILER

    array(
      'name' => __( 'Analytics', 'cmb2' ),
      'desc' => __( '', 'cmb2' ),
      'id'   => $prefix . 'analytics_title',
      'type' => 'title',
    ),
    array(
      'name' => __( 'Google Analytics Tracking ID', 'IGV' ),
      'desc' => __( '(optional)', 'IGV' ),
      'id'   => $prefix . 'google_analytics_id',
      'type' => 'text',
    ),

  )
);

IGV_init_options_page($page_key, $page_key, $page_title, $metabox);
