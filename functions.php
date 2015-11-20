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

/**
 * Create a custom post type
 *
 * @param string $name                    The name of the post type
 * @param string $label                   Used to generate labels different to the name
 * @param string $icon                    Dashicon to use for WordPress admin
 * @param bool $exclude_from_search       Show in search results?
 * @param array $rewrite                  Options for changing the slug in front of the post type
 * @param array $supports                 Options for changing what the post type supports (title, editor, thumbnail, etc)
 * @return                                Custom post type arguments
 * @since 1.0
 */
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

/**
 * Create arguments for a custom taxonomy
 *
 * @param string $name      The name of the taxonomy
 * @param string $label     Used to generate labels different to the name
 * @return                  Custom taxonomy arguments
 * @since 1.0
 */
function create_custom_taxonomy_args($name, $label = null) {
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

/**
 * Checks to see if the specified email address has a Gravatar image.
 *
 * @param $email_address  The email of the address of the user to check
 * @return                Whether or not the user has a gravatar
 * @since 1.0
 */
function has_gravatar( $email_address ) {

  // Build the Gravatar URL by hasing the email address
  $url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';

  // Now check the headers...
  $headers = @get_headers( $url );

  // If 200 is found, the user has a Gravatar; otherwise, they don't.
  return preg_match( '|200|', $headers[0] ) ? true : false;

} // end example_has_gravatar



/*
============================================================
  Add things to WordPress
============================================================
*/

// Add featured image support and sizes
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 2000, 1125, true ); //Slide width
add_image_size( 'slide-small', 1280, 720, true ); //Slide width small
add_image_size( 'banner', 2000, 800, true ); //Featured image banner size
add_image_size( 'banner-small', 1500, 800, true ); //Featured image banner size

// Add menu support
add_theme_support( 'menus' );

// Add custom menu
function register_custom_menu() {
  register_nav_menu( 'primary', 'Main Menu' );
  register_nav_menu( 'side-nav', 'Side Menu' );
}
add_action( 'after_setup_theme', 'register_custom_menu' );

// Add WP 4.4 new title tag functionality
add_theme_support( 'title-tag' );

// Editor stylesheet
add_editor_style( 'assets/styles/css/editor-style.css' ); //defaults to editor-style.css

// Add Typekit to TinyMCE
function add_typekit_tinymce( $plugin_array ){
  $plugin_array['typekit'] = get_template_directory_uri() . '/assets/scripts/src/typekit.tinymce.js';
  return $plugin_array;
}
add_filter("mce_external_plugins", "add_typekit_tinymce");



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
  register_taxonomy('series', 'podcast', create_custom_taxonomy_args('series', 'Series') );
  register_taxonomy('location_type', 'location', create_custom_taxonomy_args('type', 'Location Type') );
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
  //add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  //add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

  wp_register_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css' );
  wp_register_style( 'site', get_template_directory_uri() . '/assets/styles/css/style.min.css', ['font-awesome'] );

  wp_enqueue_style( 'font-awesome' );
  wp_enqueue_style( 'site' );

  // Remove and add our own version of jQuery
  wp_deregister_script( 'jquery' );

  //wp_register_script( 'typekit', '//use.typekit.net/jtz8aoh.js' );
  wp_register_script( 'jquery', get_template_directory_uri() . '/assets/scripts/dist/jquery.min.js' );
  wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/scripts/dist/modernizr.min.js', ['jquery'] );
  wp_register_script( 'holder', get_template_directory_uri() . '/assets/scripts/dist/holder.min.js', ['jquery'] );
  wp_register_script( 'site', get_template_directory_uri() . '/assets/scripts/dist/script.min.js', ['jquery', 'modernizr', 'holder'] );

  //wp_enqueue_script( 'typekit' );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'modernizr' );
  wp_enqueue_script( 'holder' );
  wp_enqueue_script( 'site' );
};

add_action( 'wp_enqueue_scripts', 'theme_files' );

function admin_theme_files() {
  // wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/scripts/dist/modernizr.min.js', ['jquery'] );
  // wp_register_script( 'admin', get_template_directory_uri() . '/assets/scripts/dist/admin.min.js', ['jquery', 'modernizr'] );
  // wp_enqueue_script( 'modernizr' );
  // wp_enqueue_script( 'admin' );
}
add_action( 'admin_enqueue_scripts', 'admin_theme_files' );


function featured_image_class($classes) {
  if ( has_post_thumbnail() ) {
    array_push( $classes, 'featured-image' );
  }
  else {
    array_push( $classes, 'no-featured-image' );
  }
  return $classes;
};
add_action( 'body_class', 'featured_image_class' );


//Add social media links to profile
function add_contact_methods( $contactmethods ) {
  // Add Twitter
  if ( !isset( $contactmethods['twitter'] ) ) {
    $contactmethods['twitter'] = 'Twitter';
  }

  // Add Facebook
  if ( !isset( $contactmethods['facebook'] ) ) {
    $contactmethods['facebook'] = 'Facebook';
  }

  // Add Instagram
  if ( !isset( $contactmethods['instagram'] ) ) {
    $contactmethods['instagram'] = 'Instagram';
  }

  // Remove Yahoo IM
  if ( isset( $contactmethods['yim'] ) ) {
    unset( $contactmethods['yim'] );
  }

  // Remove AIM
  if ( isset( $contactmethods['aim'] ) ) {
    unset( $contactmethods['aim'] );
  }

  // Remove Jabber
  if ( isset( $contactmethods['jabber'] ) ) {
    unset( $contactmethods['jabber'] );
  }

  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_contact_methods', 10, 1 );

?>