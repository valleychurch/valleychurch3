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

    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>

    <?php get_template_part( 'partials/notification' ); ?>

    <a class="c-navigation--toggle js-nav-toggle" href="#0"></a>

    <header role="banner" class="c-header u-clearfix">
      <div class="o-container o-container--full">
        <!-- <div class="u-pull-left--sm"> -->
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
                <!-- <span class="u-hide u-show-inline--sm">Valley</span><span class="u-hide u-show-inline--md">&nbsp;Church</span> -->
                <span class="u-hide u-show-inline--sm">Brand</span><span class="u-hide u-show-inline--md">&nbsp;Name</span>
              </span>
            </span>
          </a>
          <nav role="navigation" class="c-navigation">
            <div class="u-pull-right--md">
              <?php get_search_form(); ?>
            </div>
            <div class="u-pull-left--md">
              <?php wp_nav_menu( array(
                'theme_location' => 'Main Menu',
                'menu' => 'Main Menu',
                'container' => false,
                'menu_class' => 'c-menu'
              ) ); ?>
            </div>
          </nav>
          <div class="u-pull-right u-hide--lg">
            <button class="o-btn c-nav-toggle js-nav-toggle"><i class="fa fa-bars"></i></button>
          </div>
        <!-- </div> -->
      </div>
    </header>

    <main role="main">