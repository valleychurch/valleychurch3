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
    <meta name="theme-color" content="#b7312c">
    <meta name="msapplication-navbutton-color" content="#b7312c">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Typekit - Outside of functions.php so that we can async it -->
    <script src="https://use.typekit.net/jtz8aoh.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class( ); ?>>

    <?php
      //TODO: Rethink how notifications can work with an absolutely positioned header
      //get_template_part( 'partials/notification' );
    ?>

    <a class="c-navigation--toggle js-nav-toggle" href="#0"></a>

    <header role="banner" class="c-header u-clearfix">
      <div class="o-container o-container--full">
      
        <?php get_template_part( 'partials/logo' ); ?>

        <nav role="navigation" class="c-navigation u-cf">
          <div class="u-pull-right--lg u-margin u-margin--lg--none">
            <?php get_search_form(); ?>
          </div>
          <div class="u-pull-left--lg">
            <?php wp_nav_menu( array(
              'theme_location' => 'Main Menu',
              'menu' => 'Main Menu',
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

    <main class="c-main u-margin u-margin--md--double" role="main">