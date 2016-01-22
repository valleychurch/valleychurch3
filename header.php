<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/dist/touchicon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/dist/favicon.png">
    <!--[if IE]><link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/dist/favicon.ico"><![endif]-->
    <!-- or, set /favicon.ico for IE10 win -->
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/dist/tileicon.png">
    <meta name="msapplication-TileColor" content="#b21e28">
    <meta name="msapplication-navbutton-color" content="#b21e28">
    <meta name="theme-color" content="#b21e28">

    <link rel="dns-prefetch" href="//cdn.valleychurch.eu">
    <link rel="dns-prefetch" href="//use.typekit.net">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Inline Critical CSS -->
    <style><?php echo file_get_contents( get_template_directory_uri() . '/assets/styles/css/critical.min.css' ); ?></style>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <!--[if lt IE 9]><div class="o-container o-container--full c-browse-happy">
    <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    </div><![endif]-->

    <div class="o-container o-container--page">

      <?php get_template_part( 'partials/notification' ); ?>

      <a class="c-navigation--toggle js-nav-toggle" href="#0"></a>

      <header class="c-header u-clearfix">
        <div class="o-container o-container--full">

          <?php get_template_part( 'partials/logo' ); ?>

          <nav class="c-navigation u-cf">
            <div class="u-pull-right--lg u-margin u-margin--lg--none">
              <?php get_search_form(); ?>
            </div>
            <div class="u-pull-left--lg">
              <?php wp_nav_menu( array(
                'theme_location' => 'Nav v2',
                'menu' => 'Nav v2',
                'container' => false,
                'menu_class' => 'c-menu u-cf'
              ) ); ?>
            </div>
          </nav>
          <div class="u-pull-right u-hide--lg">
            <button class="o-btn c-nav-toggle js-nav-toggle">Menu&nbsp;&nbsp;<i class="fa fa-lg fa-bars"></i></button>
          </div>
        </div>
      </header>

      <main class="c-main">