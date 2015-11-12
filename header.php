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

    <?php get_template_part( 'partials/notification' ); ?>

    <header role="banner" class="c-header u-clearfix">
      <div class="o-container">
        <div class="u-pull-left--sm">
          <a class="logo u-pull-left" href="#0">
            <span class="o-flag">
              <span class="o-flag__fix">
                <!-- <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/icon.svg" width="48" height="48"> -->
                <img src="//placehold.it/48">
                <!-- <object title="<?php bloginfo( 'name' ); ?>" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/assets/images/icon.svg">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon.svg">
                </object> -->
              </span>
              <span class="o-flag__fix">
                <span class="u-hide u-show-inline--sm">
                  Brand
                </span>
                <span class="u-hide u-show-inline--md">
                   Name
                </span>
              </span>
            </span>
          </a>
          <nav role="navigation" class="c-navigation u-pull-left--sm">
            <?php wp_nav_menu( array(
              'theme_location' => 'Main Menu',
              'menu' => 'Main Menu',
              'container' => false,
              'menu_class' => 'c-menu'
            ) ); ?>
          </nav>
        </div>
        <div class="u-pull-right--sm">
          <?php get_search_form(); ?>
        </div>
      </div>
    </header>

    <main role="main">