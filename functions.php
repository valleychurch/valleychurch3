<?php

/**
 * Configs
 */

define( 'VC_THEME_VERSION', '3.2.12' );
define( 'APP_ACCOUNT', 'valley' );
define( 'APP_APPLICATION', 'valleychurch-website' );
define( 'APP_AUTH', 'Dg8lHr5mIg30qcVdN7Je' );
define( 'APP_URL', 'https://api.churchsuite.co.uk/v1/calendar/events?group_by_sequence=true&per_page=200' );

include( ABSPATH . 'wp-admin/includes/image.php' );

/**
 * Reusable functions
 */

/**
 * Check if a string is plural
 *
 * @param string $string String to check
 *
 * @return bool
 */
function check_plural( $string ) {
  return ( substr( $string, -1 ) == 's' );
}

/**
 * Create a singular string
 *
 * @param string $name String to make singular
 * @param string $label Label to override
 *
 * @return string
 *
 */
function create_singular( $name, $label = null ) {
  return ( ( $label != null ) ? ( $label ) : ( ucwords( $name ) ) );
}

/**
 * Create a plural string
 *
 * @param string $name String to make plural
 * @param string $label Label to override
 * @param string $nameplural Plural name to override
 * @param string $labelplural Plural label to override
 *
 * @return string
 */
function create_plural( $name, $label = null, $nameplural, $labelplural ) {
  return ( ( $label != null ) ?( $labelplural ? $label : $label . 's' ) : ( $nameplural ? ucwords( $name ) : ucwords( $name ) . 's' ) );
}

/**
 * Create a custom post type
 */
function create_custom_post_type_args( $name, $label = null, $icon = null, $exclude_from_search = true, $rewrite = null, $supports = null, $publicly_queryable = true ) {
  $nameplural = check_plural( $name );
  $labelplural = check_plural( $label );
  $singular = create_singular( $name, $label );
  $plural = create_plural( $name, $label, $nameplural, $labelplural );
  $supports = ( ( $supports != null ) ? $supports : array( 'title', 'editor', 'thumbnail', 'author', 'revisions', 'excerpt' ) );
  $rewrite = ( ( $rewrite != null ) ? $rewrite : array( 'slug' => $name, 'with_front' => false ) );
  $args = array(
    'public' =>                 true,
    'labels' => array(
      'name' =>                 $plural,
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
    'exclude_from_search' =>    $exclude_from_search,
    'rewrite' =>                $rewrite,
    'supports' =>               $supports,
    'menu_icon' =>              $icon,
    'hierarchical' =>           false,
    'capability_type' =>        'post',
    'has_archive' =>            ( $name === "message" ? true : false ),
    'publicly_queryable' =>     $publicly_queryable,
    'taxonomies'  =>            array( 'category' ),
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
    'hierarchical' =>           true,
    'labels' => array(
      'name' =>                 $plural,
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
    'show_admin_column' =>      true,
    'public' =>                 true,
    'rewrite' => array(
      'slug' =>                 $name,
      'with_front' =>           false,
    ),
  );

  return $args;
}

/**
 * Checks to see if the specified email address has a Gravatar image.
 */
function has_gravatar( $email_address ) {
  $url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';
  $headers = @get_headers( $url );
  return preg_match( '|200|', $headers[0] ) ? true : false;
}

/**
 * Blur an image
 */
function blur_image( $filename, $upload_dir ) {
  $original_image_path = trailingslashit( $upload_dir['path'] ) . $filename;

  $image_resource = new Imagick( $original_image_path );
  $image_resource->gaussianBlurImage( 10, 100 ); // See: http://phpimagick.com/Imagick/gaussianBlurImage

  return save_blurred_image( $image_resource, $original_image_path );
}


/**
 * Save a blurred image to WordPress' media library
 */
function save_blurred_image( $image_resource, $original_image_path ) {
  $image_data = pathinfo( $original_image_path );
  $new_filename = $image_data['filename'] . '-blurred.' . $image_data['extension'];

  $blurred_image_path = str_replace($image_data['basename'], $new_filename, $original_image_path);

  if ( !$image_resource->writeImage( $blurred_image_path ) )
    return $image_data['basename'];

  unlink( $original_image_path );

  return $new_filename;
}


/**
 * Add things to WordPress
 */


/**
 * Compress jpg images to 82% quality (match WordPress 4.5 default)
 * https://make.wordpress.org/core/2016/03/12/performance-improvements-for-images-in-wordpress-4-5/
 */
add_filter( 'jpeg_quality', create_function( '', 'return 82;' ) );

/**
 * Add post thumbnails and custom image sizes
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 2000, 1125, true );        // 16:9 slide full-size
add_image_size( 'slide-medium', 1280, 720, true );  // 16:9 slide medium
add_image_size( 'slide-small', 640, 360, true );    // 16:9 slide small
add_image_size( 'banner-xxl', 2000, 1125, true );   // Featured image banner xxl
add_image_size( 'banner-xl', 1680, 945, true );     // Featured image banner xl
add_image_size( 'banner-lg', 1280, 720, true );     // Featured image banner lg
add_image_size( 'banner-md', 960, 540, true );      // Featured image banner md
add_image_size( 'banner-sm', 640, 360, true );      // Featured image banner sm
add_image_size( 'banner-xs', 320, 180, true );      // Featured image banner xs

/**
 * Generate a blurred image
 * @link https://codeable.io/community/how-to-watermark-wordpress-images-with-imagemagick/
 * @link ttps://blog.noort.be/2014/07/15/imagemagick-on-iis-pain.html
 */
function generate_blurred_image( $meta ) {
  $time = substr( $meta['file'], 0, 7); // Extract the date in form "2015/04"
  $upload_dir = wp_upload_dir( $time ); // Get the "proper" upload dir

  $filename = $meta['sizes']['banner-blur']['file'];
  $meta['sizes']['banner-blur']['file'] = blur_image( $filename, $upload_dir );

  return $meta;
}
//add_filter( 'wp_generate_attachment_metadata', 'generate_blurred_image' );

/**
 * Add custom menu support and register a menu
 */
add_theme_support( 'menus' );

function register_custom_menu() {
  register_nav_menu( 'main-menu', 'Main Menu' );
  register_nav_menu( 'footer-new-here', 'Footer "New Here?"' );
  register_nav_menu( 'footer-services', 'Footer "Services"' );
  register_nav_menu( 'footer-church-life', 'Footer "Church Life"' );
  register_nav_menu( 'footer-watch-read', 'Footer "Watch & Read"' );
  register_nav_menu( 'footer-get-involved', 'Footer "Get Involved"' );
  register_nav_menu( 'footer-people-matter', 'Footer "People Matter"' );
  register_nav_menu( 'footer-venue-hire', 'Footer "Venue Hire"' );
}
add_action( 'after_setup_theme', 'register_custom_menu' );

/**
 * Add WordPress 3.6 HTML5 markup
 */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/**
 * Add WordPress 4.4 custom title tagfunc
 */
add_theme_support( 'title-tag' );

/**
 * Add editor stylesheet to TinyMCE
 */
add_editor_style( 'assets/styles/css/editor-style.' . VC_THEME_VERSION . '.css' ); //defaults to editor-style.css

/**
 * Add Typekit to TinyMCE
 */
function add_typekit_tinymce( $plugin_array ) {
  $plugin_array['typekit'] = get_template_directory_uri() . '/assets/scripts/src/typekit.tinymce.js?ver=' . VC_THEME_VERSION;
  return $plugin_array;
}
add_filter("mce_external_plugins", "add_typekit_tinymce");

/**
 * Add custom login CSS
 */
function add_custom_login() {
  echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/styles/css/login.' . VC_THEME_VERSION . '.min.css">';
  echo '<script src="//use.typekit.net/mql5wis.js"></script>';
  echo '<script>try{Typekit.load({ async: true });}catch(e){}</script>';
}
add_action( 'login_head', 'add_custom_login' );

/**
 * Create custom post types
 */
function create_custom_post_types() {
  $supports_simple = array( 'title', 'thumbnail', 'author' );
  // register_post_type( 'events', create_custom_post_type_args( 'event', 'Events (DEPRECATED)', 'dashicons-calendar-alt', true, null, null, false ) );
  register_post_type( 'event', create_custom_post_type_args( 'event', 'Events', 'dashicons-calendar-alt', true, null, null, true ) ); //Replacing old events
  register_post_type( 'slider', create_custom_post_type_args( 'slide', null, 'dashicons-images-alt', true, null, $supports_simple, false ) );
  register_post_type( 'podcast', create_custom_post_type_args( 'message', null, 'dashicons-microphone', false, null, null, true ) );
  register_post_type( 'connect', create_custom_post_type_args( 'connect', 'Connect Group', 'dashicons-admin-multisite', true, null, null, false ) );
  register_post_type( 'location', create_custom_post_type_args( 'location', 'Location', 'dashicons-location', false, ['slug' => 'locations', 'with_front' => false], null, true ) );
  register_post_type( 'staff', create_custom_post_type_args( 'staff', 'Team Member', 'dashicons-id-alt', true, null, null, false ) );
  register_post_type( 'notification', create_custom_post_type_args( 'notification', null, 'dashicons-warning', true, null, null, false ) );
};
add_action( 'init', 'create_custom_post_types' );

/**
 * Create custom taxonomies
 */
function create_custom_taxonomies() {
  register_taxonomy( 'series', 'podcast', create_custom_taxonomy_args( 'series', 'Series' ) );
  register_taxonomy( 'location_type', 'location', create_custom_taxonomy_args( 'type', 'Location Type' ) );
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
  if ( !is_user_logged_in() ) {
    wp_register_style( 'site', get_template_directory_uri() . '/assets/styles/css/style.' . VC_THEME_VERSION . '.min.css', null, null );
  }
  else {
    wp_register_style( 'site', '//valleychurch.eu/wp-content/themes/valleychurch3/assets/styles/css/style.latest.min.css', null, null );
  }

  wp_enqueue_style( 'site' );

  // Remove built in jQuery
  wp_deregister_script( 'jquery' );

  // Register our scripts
  wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyCsaESemSF6YjvYG4Vrz9bDerYZaD3f2i4', null, null, false );
  wp_register_script( 'trackomatic', '//d1lmnvs8gamzin.cloudfront.net/1.1.1/trackomatic.min.js', null, null, false );
  wp_register_script( 'font-awesome', '//use.fontawesome.com/33dd05d2f3.js', null, null, true ); /* Edit at cdn.fontawesome.com */
  wp_register_script( 'jquery', get_template_directory_uri() . '/assets/scripts/dist/jquery.min.js', null, null, true );

  if ( !is_user_logged_in() ) {
    wp_register_script( 'site', get_template_directory_uri() . '/assets/scripts/dist/script.' . VC_THEME_VERSION . '.min.js', [ 'jquery' ], null, true );
  }
  else {
    wp_register_script( 'site', '//valleychurch.eu/wp-content/themes/valleychurch3/assets/scripts/dist/script.latest.min.js', [ 'jquery' ], null, true );
  }

  if ( is_page( 'connect' ) || is_page( 'locations' ) || is_singular( 'location' ) ) {
    wp_enqueue_script( 'google-maps' );
  }
  wp_enqueue_script( 'trackomatic' );
  wp_enqueue_script( 'font-awesome' );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'site' );
};
add_action( 'wp_enqueue_scripts', 'theme_files' );


/**
 * Add `async` and `defer` attributes to some built in WP scripts
 */
function add_defer_attribute( $tag ) {
  $scripts_to_defer = array( 'contact-form-7', 'jetpack', 'wp-embed' );
  foreach( $scripts_to_defer as $defer_script) {
    if( true == strpos( $tag, $defer_script ) )
      return str_replace( ' src', ' defer="defer" src', $tag );
  }

  $scripts_to_async = array( 'comment-reply.min.js', 'custom.js' );
  foreach( $scripts_to_async as $async_script ) {
    if( true == strpos( $tag, $async_script ) )
      return str_replace( ' src', ' async="async" src', $tag );
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

/**
 * Remove `ver` querystring
 */
function _remove_script_version( $src ){
  $parts = explode( '?ver', $src );
  return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


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
}
add_action( 'body_class', 'featured_image_class' );

/**
 * Remove `p` tags around images and iframes
 */
function filter_ptags_on_content($content) {
  $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter( 'the_content', 'filter_ptags_on_content' );

/**
 * Custom read more link
 */
function modify_read_more_link() {
  return '<a class="o-btn" href="' . get_permalink() . '" role="button">Read more</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**
 * Add social media links to profile
 */
function add_contact_methods( $contactmethods ) {
  // Add Twitter
  if ( !isset( $contactmethods['twitter'] ) )
    $contactmethods['twitter'] = 'Twitter';

  // Add Facebook
  if ( !isset( $contactmethods['facebook'] ) )
    $contactmethods['facebook'] = 'Facebook';

  // Add Instagram
  if ( !isset( $contactmethods['instagram'] ) )
    $contactmethods['instagram'] = 'Instagram';

  // Remove Yahoo IM
  if ( isset( $contactmethods['yim'] ) )
    unset( $contactmethods['yim'] );

  // Remove AIM
  if ( isset( $contactmethods['aim'] ) )
    unset( $contactmethods['aim'] );

  // Remove Jabber
  if ( isset( $contactmethods['jabber'] ) )
    unset( $contactmethods['jabber'] );

  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_contact_methods', 10, 1 );


/**
 * Add custom post type options to a select menu
 * http://www.mattross.io/2014/08/25/programmatic-selectable-recipients-with-pipes-in-wpcf7/
 */
function dynamic_select_list( $tag, $unused ) {
  $options = (array)$tag['options'];

  foreach( $options as $option )
    if ( preg_match( '%^posttype:([-0-9a-zA-Z_]+)$%', $option, $matches ) )
      $term = $matches[1];

  if ( !isset( $term ) )
    return $tag;

  $befores = $tag['pipes']->collect_befores();
  $afters = $tag['pipes']->collect_afters();

  $pipes_new = array();
  for( $i = 0; $i < count($befores); $i++ ) {
    $pipes_new[] = $befores[$i] . '|' . $afters[$i];
  }

  $args = array (
    'posts_per_page' => -1,
    'post_type' => $term
  );

  $cpts = get_posts( $args );

  if ( !$cpts )
    return $tag;

  foreach ( $cpts as $cpt ) {
    $id = $cpt->ID;
    $title = $cpt->post_title;
    $email = get_field( 'email_address', $id );

    $tag['raw_values'][] = $title;
    $tag['values'][] = $id;
    $tag['labels'][] = $title;
    $pipes_new[] = $title . '|' . $email;
  }

  $tag['pipes'] = new WPCF7_Pipes( $pipes_new );

  return $tag;
}
add_filter( 'wpcf7_form_tag', 'dynamic_select_list', 10, 2 );


/**
 * Remove WP emoji
 */
function disable_wp_emojicons() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

/**
 * Remove WP emoji from TinyMCE
 */
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

/**
 * Remove `Customizer` from wpadminbar
 */
function remove_some_nodes_from_admin_top_bar_menu( $wp_admin_bar ) {
  $wp_admin_bar->remove_menu( 'customize' );
}
add_action( 'admin_bar_menu', 'remove_some_nodes_from_admin_top_bar_menu', 999 );

/**
 * Load map info
 */
function load_map( $map_centre = "mapCentre", $zoom = 9, $auto_size = true, $location_array, $info_window_content = "", $marker_click, $scrollable ) {
?>
<script>
  var locationArray = [<?= $location_array; ?>];
  Valley.InitMap(<?= $map_centre ?>, <?= $zoom ?>, <?= (int)$auto_size ?>, locationArray, <?= $info_window_content ?>, <?= (int)$marker_click ?>, <?= (int)$scrollable ?>);
</script>
<?php
}
add_action( 'load_map', 'load_map' );

/**
 * Load connect groups using `load_map_info`
 */
function load_connect_groups() {
  $location_array;
  $info_window_content = '"<h3 class=\'h4 u-margin--half\'>" + this.title + "</h3>" + this.html';

  $args =
    array(
      'post_type' => 'connect',
      'post_status' => array( 'publish' ),
      'posts_per_page' => -1,
    );

  $wp_query = new WP_Query( $args );
  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();
      $location_array .= "[" . get_field( 'cg_location' ) . ",'" . get_the_title() . "','" . get_the_content() . "',''],";
    }
  }

  load_map( 'mapCentre', 9, true, $location_array, $info_window_content, false, true );
}
add_action( 'load_connect_groups', 'load_connect_groups' );

/**
 * Load locations map using `load_map_info`
 */
function load_locations() {
  $location_array;

  $args =
    array(
      'post_type' => 'location',
      'post_status' => array( 'publish' ),
      'posts_per_page' => -1,
      'meta_query' => array(
        array(
          'key'       => 'hide_on_homepage',
          'value'     => '1',
          'compare'   => '!='
        )
      )
    );

  $wp_query = new WP_Query( $args );
  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();
      $location_array .= "[" . get_field( 'location' )['coordinates'] . ",'" . get_the_title() . "','','" . get_permalink() . "'],";
    }
  }

  load_map( 'mapCentre', 9, true, $location_array, "''", true, false );
}
add_action( 'load_locations', 'load_locations' );

/**
 * Load single location map using `load_map_info`
 */
function load_location() {
  global $post;
  $location_array;

  $args =
    array(
      'post_type' => 'location',
      'p' => $post->ID,
      'post_status' => array( 'publish' ),
      'posts_per_page' => -1,
    );

  $wp_query = new WP_Query( $args );
  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();
      $location_array .= "[" . get_field( 'location' )['coordinates'] . ",'" . get_the_title() . "','','" . get_permalink() . "'],";
      $map_centre = "new google.maps.LatLng(" . get_field( 'location' )['coordinates'] . ")";
    }
  }

  load_map( $map_centre, 15, false, $location_array, "''", false, false );
}
add_action( 'load_location', 'load_location' );

/**
 * Add ACF options page under Locations CPT
 */
// if ( function_exists( 'acf_add_options_sub_page' ) ) {
//   $args = array(
//     'title'       => 'Location Settings',
//     'parent'      => 'edit.php?post_type=location',
//     'capability'  => 'manage_options'
//   );
//   acf_add_options_sub_page( $args );
// }

function rewrite_url_to_cdn_url($url){
  // check if W3 Total Cache is installed
  if(class_exists('W3_Plugin_Cdn')){
      $w3tc_instance = new W3_Plugin_Cdn();
      $path        = str_replace(site_url() . '/','', $url);
      $cdn         = $w3tc_instance->_get_common()->get_cdn();
      $remote_path = $w3tc_instance->_get_common()->uri_to_cdn_uri($path);
      $new_url     = $cdn->format_url($remote_path);
  } else {
      $new_url = $url;
  }
  return $new_url;
}

/**
 * Add ChurchSuite events to WP
 */
function import_churchapp_events() {
  import_churchsuite_events();
}

function import_churchsuite_events() {
  $date_today = date("Y-m-d");
  $date_future = date("Y-m-d", strtotime("+3 months"));

  $ch = curl_init(APP_URL . "&date_start=" . $date_today . "&date_end=" . $date_future);
  curl_setopt_array($ch,
    array(
      CURLOPT_TIMEOUT => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_HTTPHEADER => array(
        'X-Account: ' . APP_ACCOUNT,
        'X-Application: ' . APP_APPLICATION,
        'X-Auth: ' . APP_AUTH
      )
    )
  );

  $result = curl_exec($ch);

  curl_close($ch);

  $json = json_decode($result);
  $events = $json->events;
  $email = "Request URL: " . APP_URL . "&date_start=" . $date_today . "&date_end=" . $date_future . "<br/><br/>";

  foreach( $events as $event ) {
    if ( $event->public_visible == "1" && $event->signup_options->public->featured == "1" && $event->category->id != "5" && $event->category->id != "11" ) {
      //Check against currently added events
      $wp_event = new WP_Query(
        array(
          'post_count'  => -1,
          'post_type'   => 'event',
          'meta_key'    => 'identifier',
          'meta_value'  => $event->identifier
        )
      );

      // If it's not found in the DB we can add it
      if ( $wp_event->post_count == 0 ) {
        $post_id = wp_insert_post(
          array(
            'post_type' => 'event',
            'post_title' => $event->name,
            'post_content' => $event->description,
            'post_status' => 'publish',
            'post_author' => 2,
            'comment_status' => 'closed',
            'ping_status' => 'closed',
          )
        );

        // If it's successfully added to the DB
        if ( $post_id ) {
          $email .= "Successfully added " . $event->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a> to WP<br/>";

          // Add expiry date
          _scheduleExpiratorEvent( $post_id, strtotime( $event->datetime_end ), array( 'expireType' => 'draft', 'id' => $post_id ) );

          // Update ACF fields
          update_field( 'field_582456c4b953e', $event->identifier, $post_id );
          update_field( 'field_582456d0b953f', $event->datetime_start, $post_id );
          update_field( 'field_58249be78d880', strtotime($event->datetime_start), $post_id );
          update_field( 'field_582456e3b9540', $event->datetime_end, $post_id );

          if (date("H:i:s", strtotime($event->datetime_start)) == "00:00:00" && date("H:i:s", strtotime($event->datetime_end)) == "23:59:59") {
            update_field( 'field_58c7f7bf045c3', 1, $post_id );
          } else {
            update_field( 'field_58c7f7bf045c3', 0, $post_id );
          }

          if ( count( $event->location ) != 0 ) {
            update_field( 'field_582456f3b9541', $event->location->name, $post_id );
            update_field( 'field_582456ffb9542', $event->location->address, $post_id );
            update_field( 'field_58245707b9543', $event->location->latitude, $post_id );
            update_field( 'field_5824570fb9544', $event->location->longitude, $post_id );
          }
          update_field( 'field_5824571ab9545', $event->signup_options->tickets->enabled, $post_id );
          update_field( 'field_58245724b9546', $event->signup_options->tickets->url, $post_id );

          // Try and get the image
          if ( count( $event->images ) > 0 ) {
            $file = $event->images->lg->url;
            add_media_to_wp($event, $file, $post_id);
          }
        }

        // Fail, do something with the error?
        else {
          $email .= "Couldn't add " . $event->name . " to WP<br/>";
        }
      }

      // Run an update?
      else {
        $post_to_update = $wp_event->posts[0];
        $post_id = $post_to_update->ID;
        $update_count = 1;

        //Basic object to add data to
        $updated_info = array(
          'ID' => $post_id
        );

        if ( esc_html($post_to_update->post_title) != esc_html( $event->name ) ) {
          $updated_info["post_title"] = $event->name;
          $update_count++;
        }

        if ( $post_to_update->post_content != $event->description ) {
          $updated_info["post_content"] = $event->description;
          $update_count++;
        }

        if ( get_field( 'identifier', $post_to_update) != $event->identifier ) {
          update_field( 'field_582456c4b953e', $event->identifier, $post_id );
          $update_count++;
        }

        if ( get_field( 'datetime_start', $post_to_update) != $event->datetime_start ) {
          update_field( 'field_582456d0b953f', $event->datetime_start, $post_id );
          $update_count++;
        }

        if ( get_field( 'datetimestamp_start', $post_to_update) != strtotime( $event->datetime_start ) ) {
          update_field( 'field_58249be78d880', strtotime($event->datetime_start), $post_id );
          $update_count++;
        }

        if ( get_field( 'datetime_end', $post_to_update) != $event->datetime_end ) {
          update_field( 'field_582456e3b9540', $event->datetime_end, $post_id );
          _unscheduleExpiratorEvent( $post_id );
          _scheduleExpiratorEvent( $post_id, strtotime( $event->datetime_end ), array( 'expireType' => 'draft', 'id' => $post_id ) );
          $update_count++;
        }

        if (date("H:i:s", strtotime($event->datetime_start)) == "00:00:00" && date("H:i:s", strtotime($event->datetime_end)) == "23:59:59") {
          update_field( 'field_58c7f7bf045c3', 1, $post_id );
        } else {
          update_field( 'field_58c7f7bf045c3', 0, $post_id );
        }

        if ( count( $event->location ) != 0 ) {
          if ( get_field( 'location', $post_to_update) != $event->location->name ) {
            update_field( 'field_582456f3b9541', $event->location->name, $post_id );
            $update_count++;
          }

          if ( get_field( 'location_address', $post_to_update) != $event->location->address ) {
            update_field( 'field_582456ffb9542', $event->location->address, $post_id );
            $update_count++;
          }

          if ( get_field( 'location_latitude', $post_to_update) != $event->location->latitude ) {
            update_field( 'field_58245707b9543', $event->location->latitude, $post_id );
            $update_count++;
          }

          if ( get_field( 'location_longitude', $post_to_update) != $event->location->longitude ) {
            update_field( 'field_5824570fb9544', $event->location->longitude, $post_id );
            $update_count++;
          }
        }

        if ( get_field( 'signup_available', $post_to_update) != $event->signup_options->tickets->enabled ) {
          update_field( 'field_5824571ab9545', $event->signup_options->tickets->enabled, $post_id );
          $update_count++;
        }

        if ( get_field( 'signup_url', $post_to_update) != $event->signup_options->tickets->url ) {
          update_field( 'field_58245724b9546', $event->signup_options->tickets->url, $post_id );
          $update_count++;
        }

        //Update post if there's more data than just ID
        if ( $update_count > 1 ) {
          wp_update_post( $updated_info );
          $email .= "Updated " . $event->name . " (ID: " . $post_id . ")<br/>";
        }

        else {
          $email .= "No need to update " . $event->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a><br/>";
        }

        // See if there's a featured image to add
        if ( count( $event->images ) > 0 ) {
          // Clear previous images
          $media = get_attached_media( 'image', $post_id );
          if ( count( $media ) > 0 ) {
            foreach( $media as $image ) {
              wp_delete_attachment( $image->ID, true );
            }
          }

          // Add new image
          $file = $event->images->lg->url;
          add_media_to_wp($event, $file, $post_id);
        }

      }
    }
  }

  if ( !empty( $email ) ) {
    echo $email;
    wp_mail( 'web@valleychurch.eu', 'ChurchSuite event import ' . date( 'd/m/Y' ), $email, array( 'Content-Type: text/html; charset=UTF-8' ) );
  }
}
add_action( "import_churchsuite_events", "import_churchsuite_events" );
add_action( "wp_ajax_import_churchsuite_events", "import_churchsuite_events" );
add_action( "wp_ajax_nopriv_import_churchsuite_events", "import_churchsuite_events" );

/**
 * Add media to WP by URL
 */
function add_media_to_wp($event, $file, $post_id) {
  $filename = basename( $file );

  $upload_file = wp_upload_bits( $filename, null, file_get_contents( $file ) );
  if ( !$upload_file['error'] ) {
    $wp_filetype = wp_check_filetype( $filename, null );
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_parent' => $post_id,
      'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
      'post_content' => '',
      'post_status' => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
    if ( !is_wp_error( $attachment_id ) ) {
      $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
      wp_update_attachment_metadata( $attachment_id,  $attachment_data );
      set_post_thumbnail( $post_id, $attachment_id );
    }
  }
}


/**
 * Add AMP styles
 */
add_filter( 'amp_content_max_width', 'vc_amp_change_content_width' );
function vc_amp_change_content_width( $content_max_width ) {
    return 800;
}

add_action( 'amp_post_template_css', 'vc_amp_additional_css' );
function vc_amp_additional_css( $amp_template ) {
    echo file_get_contents('wp-content/themes/valleychurch3/assets/styles/css/amp.min.css');
}

// add_action( 'amp_post_template_footer', 'vc_amp_additional_js' );
function vc_amp_additional_js( $amp_template ) {
  ?>
  <!-- Load Typekit ASAP (kit id jtz8aoh) -->
  <!-- https://blog.5apps.com/2014/02/21/using-typekit-the-right-way-with-an-improved-loading-script.html -->
  <script>
    (function(d) {
      var tkTimeout=3000;
      if(window.sessionStorage){if(sessionStorage.getItem('useTypekit')==='false'){tkTimeout=0;}}
      var config = {
        kitId: 'jtz8aoh',
        scriptTimeout: tkTimeout
      },
      h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+"wf-inactive";if(window.sessionStorage){sessionStorage.setItem("useTypekit","false")}},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+="wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
    })(document);
  </script>
  <?php
}

?>
