<?php

/*
============================================================
  Reusable functions
============================================================
*/

// Check if things are plural
function check_plural($string) {
  return ( substr( $string, -1 ) == 's' );
}

function create_singular($name, $label = null) {
  return ( ( $label != null ) ? ( $label ) : ( ucwords( $name ) ) );
}

function create_plural($name, $label = null, $nameplural, $labelplural) {
  return ( ( $label != null ) ?( $labelplural ? $label : $label . 's' ) : ( $nameplural ? ucwords( $name ) : ucwords( $name ) . 's' ) );
}

// Function for default arguments when creating a custom post type
function create_custom_post_type_args($name, $label = null, $icon = null, $exclude_from_search = true, $rewrite = null, $supports = null) {
  $nameplural = check_plural( $name );
  $labelplural = check_plural( $label );
  $singular = create_singular( $name, $label );
  $plural = create_plural( $name, $label, $nameplural, $labelplural );
  $supports = ( ( $supports != null ) ? $supports : array( 'title', 'editor', 'thumbnail', 'author', 'revisions', 'excerpt' ) );
  $rewrite = ( ( $rewrite != null ) ? $rewrite : array( 'slug' => $name, 'with_front' => false ) );
  $args = array(
    'public' => true,
    'labels' => array(
      'name' => $plural,
      'singular_name' => $singular,
      'add_new' => _x( 'Add New', $name ),
      'add_new_item' => __( 'Add New ' . $singular ),
      'edit_item' => __( 'Edit ' . $singular ),
      'new_item' => __( 'New ' . $singular ),
      'all_items' => __('All ' . $plural),
      'view_item' => __('View ' . $singular ),
      'search_items' => __('Search ' . $plural),
      'not_found' =>  __('No ' . $plural . ' found'),
      'not_found_in_trash' => __('No ' . $plural . ' found in trash'),
    ),
    'exclude_from_search' => $exclude_from_search,
    'rewrite' => $rewrite,
    'supports' => $supports,
    'menu_icon' => $icon
  );
  return $args;
}

// Function for default arguments when creating a custom taxonomy
function create_custom_taxonomy($name, $label = null) {
  $nameplural = check_plural( $name );
  $labelplural = check_plural( $label );
  $singular = create_singular( $name, $label );
  $plural = create_plural( $name, $label, $nameplural, $labelplural );
  $args = array(
    'hierarchical' => true,
    'labels' => array(
      'name' => $plural,
      'singular_name' => $singular,
      'add_new' => _x( 'Add New', $name ),
      'add_new_item' => __( 'Add New ' . $singular ),
      'edit_item' => __( 'Edit ' . $singular ),
      'new_item' => __( 'New ' . $singular ),
      'all_items' => __('All ' . $plural),
      'view_item' => __('View ' . $singular ),
      'search_items' => __('Search ' . $plural),
      'not_found' =>  __('No ' . $plural . ' found'),
    ),
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array(
      'slug' => $name, // This controls the base slug that will display before each term
      'with_front' => false // Don't display the category base before
    ),
  );

  return $args;
}





/*
============================================================
  Add things to WordPress
============================================================
*/

// Add featured image support and sizes
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 2000, 9999 ); //Slide width

// Add menu support
add_theme_support( 'menus' );

// Add custom menu
function register_custom_menu() {
  register_nav_menu( 'primary', 'Main Menu' );
}
add_action( 'after_setup_theme', 'register_custom_menu' );

// Add WP 4.4 new title tag functionality
add_theme_support( 'title-tag' );

//Editor stylesheet
add_editor_style( ); //defaults to editor-style.css


//Create custom post types
function create_custom_post_types() {
  register_post_type( 'events', create_custom_post_type_args( 'event', null, 'dashicons-calendar-alt' ) ); //TODO: rename to 'event'
  register_post_type( 'slider', create_custom_post_type_args( 'slide', null, 'dashicons-images-alt' ) ); //TODO: rename to 'slide'
  register_post_type( 'podcast', create_custom_post_type_args( 'message', null, 'dashicons-microphone' ) ); //TODO: rename to 'message'
  register_post_type( 'connect', create_custom_post_type_args( 'connect', 'Connect Group', 'dashicons-admin-multisite' ) );
  register_post_type( 'location', create_custom_post_type_args( 'location', 'Location', 'dashicons-location' ) );
  register_post_type( 'staff', create_custom_post_type_args( 'staff', 'Staff Member', 'dashicons-id-alt' ) );
  register_post_type( 'notification', create_custom_post_type_args( 'notification', null, 'dashicons-warning' ) );
};
add_action( 'init', 'create_custom_post_types' );


//Create custom taxonomies
function create_custom_taxonomies() {
  register_taxonomy('series', 'podcast', create_custom_taxonomy('series', 'Series') );
  register_taxonomy('location_type', 'location', create_custom_taxonomy('type', 'Location Type') );
};
add_action( 'init', 'create_custom_taxonomies' );


// Add locations as CPT-onomy
// function create_cptonomies() {
//   global $cpt_onomies_manager;
//   if ( $cpt_onomies_manager ) {
//     $cpt_onomies_manager->register_cpt_onomy( 'location', 'events' );
//   }
// };
// add_action( 'wp_loaded', 'create_cptonomies' );


//Enqueue styles and scripts
function theme_files() {
  //Tidy up some excess bits and pieces (taken from Bones)

  // EditURI link
  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
  remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
};

// add_action( 'wp_enqueue_scripts', 'theme_files' );

?>