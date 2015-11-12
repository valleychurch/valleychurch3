<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/styles/css/style.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/dist/script.min.js"></script>

    <script src="https://use.typekit.net/jtz8aoh.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>

    <?php
      $args =
        array(
          'post_type' => 'notification',
          'showposts' => 1,
          'post_status' => 'publish'
        );

      $notification = new WP_Query( $args );

      if ( $notification->have_posts() ) :
        while ( $notification->have_posts() ) :
          $notification->the_post();
    ?>

    <div class="c-notification" id="notification-<?php the_date('dmY'); ?>" style="display: none;">
      <div class="o-container">
        <?php the_content(); ?>
        <a class="c-notification__dismiss js-notification-dismiss" href="#0">
          &times;
        </a>
      </div>
    </div>

    <?php
        endwhile;
      endif;
      wp_reset_query();
    ?>

    <header role="banner" class="c-header u-clearfix">
      <div class="o-container">
        <div class="u-pull-left">
          <a class="logo u-pull-left" href="#0">
            <span class="o-flag">
              <span class="o-flag__fix">
                <!-- <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/icon.svg" width="48" height="48"> -->
                <img src="//placehold.it/48">
              </span>
              <span class="o-flag__fix">
                Brand Name
              </span>
            </span>
          </a>
          <nav role="navigation" class="c-navigation u-pull-left">
            <?php wp_nav_menu( array(
              'theme_location' => 'Main Menu',
              'menu' => 'Main Menu',
              'container' => false,
              'menu_class' => 'c-menu'
            ) ); ?>
          </nav>
        </div>
        <?php get_search_form(); ?>
      </div>
    </header>

    <main role="main">