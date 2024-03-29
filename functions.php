<?php

// Enqueue

function scripts_and_styles_method() {
  $templateuri = get_template_directory_uri();
  
  $javascriptMain = $templateuri . '/dist/main.js';

  $is_admin = current_user_can('administrator') ? 1 : 0;

  $javascriptVars = array(
    'siteUrl' => home_url(),
    'themeUrl' => get_template_directory_uri(),
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'isAdmin' => $is_admin,
  );

  wp_register_script('javascript-main', $javascriptMain);
  wp_localize_script('javascript-main', 'WP', $javascriptVars);
  wp_enqueue_script('javascript-main', $javascriptMain, '', '', true);

  wp_enqueue_style( 'style-site', get_stylesheet_directory_uri() . '/dist/main.css' );

  // dashicons for admin
  if (is_admin()) {
    wp_enqueue_style( 'dashicons' );
  }
}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');

// Declare thumbnail sizes
get_template_part( 'lib/thumbnail-sizes' );

// oEmbed
if ( ! isset( $content_width ) ) {
	$content_width = 1548;
}

// Register Nav Menus
function nm_register_menus() {
  register_nav_menus(
    array(
      'footer' => __( 'Footer Menu' ),
     )
   );
 }
add_action( 'init', 'nm_register_menus' );

// Add third party PHP libs
function cmb_initialize_cmb_meta_boxes() {
  if (!class_exists( 'cmb2_bootstrap_202' ) ) {
    require_once 'vendor/webdevstudios/cmb2/init.php';
    require_once 'vendor/webdevstudios/cmb2-post-search-field/lib/init.php';
  }
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 11 );

function composer_autoload() {
  require_once( 'vendor/autoload.php' );
}
add_action( 'init', 'composer_autoload', 10 );

// Add libs

get_template_part( 'lib/custom-gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/meta-boxes' );
get_template_part( 'lib/theme-options/theme-options' );

// Add custom functions

get_template_part( 'lib/functions-misc' );
get_template_part( 'lib/functions-custom' );
get_template_part( 'lib/functions-filters' );
get_template_part( 'lib/functions-hooks' );
get_template_part( 'lib/functions-utility' );

?>