<?php

/**
 * Configs
 */

define( 'VC_THEME_VERSION', '3.2.0' );


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
function check_plural($string) {
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
function create_singular($name, $label = null) {
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
function create_plural($name, $label = null, $nameplural, $labelplural) {
  return ( ( $label != null ) ?( $labelplural ? $label : $label . 's' ) : ( $nameplural ? ucwords( $name ) : ucwords( $name ) . 's' ) );
}

/**
 * Create a custom post type
 */
function create_custom_post_type_args( $name, $label = null, $icon = null, $exclude_from_search = true, $rewrite = null, $supports = null, $publically_queryable = true ) {
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
    'publically_queryable' =>   $publically_queryable,
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
add_image_size( 'banner', 2000, 800, true );        // Featured image banner full-size
add_image_size( 'banner-medium', 1280, 608, true ); // Featured image banner medium
add_image_size( 'banner-small', 640, 360, true );   // Featured image banner small

add_image_size( 'banner-blur', 1280, 720, true );   // Featured image banner medium blurred

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
add_filter( 'wp_generate_attachment_metadata', 'generate_blurred_image' );

/**
 * Add custom menu support and register a menu
 */
add_theme_support( 'menus' );

function register_custom_menu() {
  register_nav_menu( 'primary', 'Nav v2' );
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
  echo '<script src="//use.typekit.net/jtz8aoh.js"></script>';
  echo '<script>try{Typekit.load({ async: true });}catch(e){}</script>';
}
add_action( 'login_head', 'add_custom_login' );

/**
 * Create custom post types
 */
function create_custom_post_types() {
  $supports_simple = array( 'title', 'thumbnail', 'author' );
  register_post_type( 'events', create_custom_post_type_args( 'event', null, 'dashicons-calendar-alt', true, null, null, false ) );
  register_post_type( 'slider', create_custom_post_type_args( 'slide', null, 'dashicons-images-alt', true, null, $supports_simple, false ) );
  register_post_type( 'podcast', create_custom_post_type_args( 'message', null, 'dashicons-microphone', false, null, null, true ) );
  register_post_type( 'connect', create_custom_post_type_args( 'connect', 'Connect Group', 'dashicons-admin-multisite', true, null, null, false ) );
  register_post_type( 'location', create_custom_post_type_args( 'location', 'Location', 'dashicons-location', false, ['slug' => 'locations', 'with_front' => false], null, true ) );
  register_post_type( 'staff', create_custom_post_type_args( 'staff', 'Staff Member', 'dashicons-id-alt', true, null, null, false ) );
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
  //wp_register_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', null, null );
  wp_register_style( 'site', get_template_directory_uri() . '/assets/styles/css/style.' . VC_THEME_VERSION . '.min.css', null, null );

  //wp_enqueue_style( 'font-awesome' );
  wp_enqueue_style( 'site' );

  // Remove built in jQuery
  wp_deregister_script( 'jquery' );

  // Register our scripts
  wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyCsaESemSF6YjvYG4Vrz9bDerYZaD3f2i4', null, null, false );
  wp_register_script( 'jquery', get_template_directory_uri() . '/assets/scripts/dist/jquery.min.js', null, null, true );
  wp_register_script( 'font-awesome', '//use.fontawesome.com/33dd05d2f3.js', null, null, true );
  wp_register_script( 'cookie', get_template_directory_uri() . '/assets/scripts/dist/cookie.min.js', null, null, true );
  wp_register_script( 'site', get_template_directory_uri() . '/assets/scripts/dist/script.rewrite.' . VC_THEME_VERSION . '.min.js', [ 'jquery' ], null, true );

  if ( is_page( 'connect' ) || is_page( 'locations' ) || is_singular( 'location' ) ) {
    wp_enqueue_script( 'google-maps' );
  }
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'font-awesome' );
  wp_enqueue_script( 'cookie' );
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
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

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
 * Try and load CSS ajax in the header (if it's not already come from localStorage)
 */
function loadCSSAsync() { ?>
  <!--<script>
    <?= file_get_contents( get_template_directory_uri() . '/assets/scripts/dist/global.min.js' ); ?>
    if (!valley.css.loaded) {
      if (valley.isModernBrowser) {
        loadCSSWithAjax('<?= get_template_directory_uri() . "/assets/styles/css/style.min.css"; ?>', true);
      } else {
        loadCSSWithLink('<?= get_template_directory_uri() . "/assets/styles/css/style.min.css"; ?>');
      }
    }

    if (!valley.fontAwesome.loaded) {
      if (valley.isModernBrowser) {
        loadCSSWithAjax('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', false);
      }
      else {
        loadCSSWithLink('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css');
      }
    }
  </script>
  <script src="//use.typekit.net/jtz8aoh.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>-->
<?php
}
// add_action( 'wp_head', 'loadCSSAsync', 30 );

/**
 * Include noscript CSS in the footer
 */
function loadCSSFallback() { ?>
  <!--<noscript>
    <link href="<?= get_template_directory_uri() . '/assets/styles/css/style.min.css'; ?>" rel="stylesheet" type="text/css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  </noscript>-->
<?php }
// add_action( 'wp_footer', 'loadCSSFallback', 30 );

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
  return '<a class="o-btn c-more-link" href="' . get_permalink() . '" role="button">Read more</a>';
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
      'post_status' => array( 'publish', 'private' ),
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
      'post_status' => array( 'publish', 'private' ),
      'posts_per_page' => -1,
    );

  $wp_query = new WP_Query( $args );
  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();
      $location_array .= "[" . get_field( 'location' )['coordinates'] . ",'" . get_the_title() . "','" . get_the_content() . "','" . get_permalink() . "'],";
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
      'post_status' => array( 'publish', 'private' ),
      'posts_per_page' => -1,
    );

  $wp_query = new WP_Query( $args );
  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();
      $location_array .= "[" . get_field( 'location' )['coordinates'] . ",'" . get_the_title() . "','" . get_the_content() . "','" . get_permalink() . "']";
      $map_centre = "new google.maps.LatLng(" . get_field( 'location' )['coordinates'] . ")";
    }
  }

  load_map( $map_centre, 15, false, $location_array, "''", false, false );
}
add_action( 'load_location', 'load_location' );

/**
 * Add ACF options page under Locations CPT
 */
if ( function_exists( 'acf_add_options_sub_page' ) ) {
  $args = array(
    'page_title'  => 'Location Settings',
    'parent'      => 'edit.php?post_type=location',
    'capability'  => 'manage_options'
  );
  acf_add_options_sub_page( $args );
}

?>
