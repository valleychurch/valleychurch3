<?php

/*
============================================================
  Configs
============================================================
*/

$vc_theme_version = '3.0.0';


/*
============================================================
  Reusable functions
============================================================
*/

/**
 * Check if a string is plural
 */
function check_plural($string) {
  return ( substr( $string, -1 ) == 's' );
}

/**
 * Create a singular string
 */
function create_singular($name, $label = null) {
  return ( ( $label != null ) ? ( $label ) : ( ucwords( $name ) ) );
}

/**
 * Create a plural string
 */
function create_plural($name, $label = null, $nameplural, $labelplural) {
  return ( ( $label != null ) ?( $labelplural ? $label : $label . 's' ) : ( $nameplural ? ucwords( $name ) : ucwords( $name ) . 's' ) );
}

/**
 * Create a custom post type
 */
function create_custom_post_type_args( $name, $label = null, $icon = null, $exclude_from_search = true, $rewrite = null, $supports = null ) {
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
      'singular_name' =>        $singular,
      'add_new' =>              'Add New',
      'add_new_item' =>         'Add New ' . $singular,
      'edit_item' =>            'Edit ' . $singular,
      'new_item' =>             'New ' . $singular,
      'all_items' =>            'All ' . $plural,
      'view_item' =>            'View ' . $singular,
      'search_items' =>         'Search ' . $plural,
      'not_found' =>            'No ' . $plural . ' found',
      'not_found_in_trash' =>   'No ' . $plural . ' found in trash',
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
 */
function create_custom_taxonomy_args( $name, $label = null ) {
  $nameplural = check_plural( $name );
  $labelplural = check_plural( $label );
  $singular = create_singular( $name, $label );
  $plural = create_plural( $name, $label, $nameplural, $labelplural );
  $args = array(
    'hierarchical' => true,
    'labels' => array(
      'name' => $plural,
      'singular_name' =>        $singular,
      'add_new' =>              'Add New',
      'add_new_item' =>         'Add New ' . $singular,
      'edit_item' =>            'Edit ' . $singular,
      'new_item' =>             'New ' . $singular,
      'all_items' =>            'All ' . $plural,
      'view_item' =>            'View ' . $singular,
      'search_items' =>         'Search ' . $plural,
      'not_found' =>            'No ' . $plural . ' found',
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
 */
function has_gravatar( $email_address ) {

  // Build the Gravatar URL by hashing the email address
  $url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';

  // Now check the headers...
  $headers = @get_headers( $url );

  // If 200 is found, the user has a Gravatar; otherwise, they don't.
  return preg_match( '|200|', $headers[0] ) ? true : false;

}



/*
============================================================
  Add things to WordPress
============================================================
*/

/**
 * Add post thumbnails and custom image sizes
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 2000, 1125, true );       // Slide width
add_image_size( 'slide-small', 1280, 720, true );  // Slide width small
add_image_size( 'slide-xsmall', 640, 360, true );  // Slide width xsmall
add_image_size( 'banner', 2000, 800, true );       // Featured image banner size
add_image_size( 'banner-small', 1500, 800, true ); // Featured image banner size small
add_image_size( 'banner-xsmall', 750, 600, true ); // Featured image banner size xsmall


/**
 * Add custom menu support and register a menu
 */
add_theme_support( 'menus' );

function register_custom_menu() {
  register_nav_menu( 'primary', 'Main Menu' );
}
add_action( 'after_setup_theme', 'register_custom_menu' );


/**
 * Add WordPress 3.6 HTML5 markup
 */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );


/**
 * Add WordPress 4.4 custom title tag
 */
add_theme_support( 'title-tag' );


/**
 * Add editor stylesheet to TinyMCE
 */
add_editor_style( 'assets/styles/css/editor-style.css' ); //defaults to editor-style.css


/**
 * Add Typekit to TinyMCE
 */
function add_typekit_tinymce( $plugin_array ) {
  $plugin_array['typekit'] = get_template_directory_uri() . '/assets/scripts/src/typekit.tinymce.js';
  return $plugin_array;
}
add_filter("mce_external_plugins", "add_typekit_tinymce");


/**
 * Create custom post types
 */
function create_custom_post_types() {
  register_post_type( 'events', create_custom_post_type_args( 'event', null, 'dashicons-calendar-alt' ) );            //TODO: rename to 'event'
  register_post_type( 'slider', create_custom_post_type_args( 'slide', null, 'dashicons-images-alt' ) );              //TODO: rename to 'slide'
  register_post_type( 'podcast', create_custom_post_type_args( 'message', null, 'dashicons-microphone' ) );           //TODO: rename to 'message'
  register_post_type( 'connect', create_custom_post_type_args( 'connect', 'Connect Group', 'dashicons-admin-multisite' ) );
  register_post_type( 'location', create_custom_post_type_args( 'location', 'Location', 'dashicons-location' ) );
  register_post_type( 'staff', create_custom_post_type_args( 'staff', 'Staff Member', 'dashicons-id-alt' ) );
  register_post_type( 'notification', create_custom_post_type_args( 'notification', null, 'dashicons-warning' ) );
};
add_action( 'init', 'create_custom_post_types' );


/**
 * Create custom taxonomies
 */
function create_custom_taxonomies() {
  register_taxonomy('series', 'podcast', create_custom_taxonomy_args('series', 'Series') );
  register_taxonomy('location_type', 'location', create_custom_taxonomy_args('type', 'Location Type') );
};
add_action( 'init', 'create_custom_taxonomies' );


/**
 * Enqueue styles and scripts
 */
function theme_files() {
  //Tidy up some excess bits and pieces (taken from Bones)
  remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' );                       // windows live writer
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // links for adjacent posts
  remove_action( 'wp_head', 'wp_generator' );                           // WP version

  // Register our CSS
  wp_register_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', '4.5.0' );
  wp_register_style( 'site', get_template_directory_uri() . '/assets/styles/css/style.min.css', ['font-awesome'], $vc_theme_version );

  wp_enqueue_style( 'font-awesome' );
  wp_enqueue_style( 'site' );

  // Remove built in jQuery
  wp_deregister_script( 'jquery' );

  // Register our scripts
  wp_register_script( 'fastclick', get_template_directory_uri() . '/assets/scripts/dist/fastclick.min.js', null, '1.0.6' );
  wp_register_script( 'jquery', get_template_directory_uri() . '/assets/scripts/dist/jquery.min.js', null, '2.1.4' );
  wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/scripts/dist/modernizr.min.js', ['jquery'], '2.8.3' );
  wp_register_script( 'responsiveslides', get_template_directory_uri() . '/assets/scripts/dist/responsiveslides.min.js', ['jquery'], '1.54' );
  wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js' );
  wp_register_script( 'site', get_template_directory_uri() . '/assets/scripts/dist/script.min.js', ['jquery', 'modernizr', 'responsiveslides', 'google-maps'], $vc_theme_version );

  wp_enqueue_script( 'fastclick' );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'modernizr' );
  wp_enqueue_script( 'responsiveslides' );
  wp_enqueue_script( 'google-maps' );
  wp_enqueue_script( 'site' );
};

add_action( 'wp_enqueue_scripts', 'theme_files' );


/**
 * Add script async support
 */
function defer_js_async( $tag ) {
  $scripts_to_defer = array( 'script.min.js', 'fastclick.min.js' );
  $scripts_to_async = array( 'jquery.min.js', 'modernizr.min.js', 'responsiveslides.min.js');

  foreach( $scripts_to_defer as $defer_script ) {
    if( true == strpos( $tag, $defer_script ) )
      return str_replace( ' src', ' defer="defer" src', $tag );
  }
  foreach( $scripts_to_async as $async_script ) {
    if( true == strpos( $tag, $async_script ) )
      return str_replace( ' src', ' async="async" src', $tag );
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'defer_js_async', 10 );


/**
 * Add class to `body` if there's a featured image
 */
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


/**
 * Custom read more link
 */
function modify_read_more_link() {
  return '<a class="o-btn c-more-link" href="' . get_permalink() . '">Read more</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


/**
 * Add social media links to profile
 */
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