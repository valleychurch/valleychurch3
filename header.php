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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/styles/css/style.min.css'; ?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <script src="<?php echo get_template_directory_uri() . '/assets/scripts/dist/script.min.js'; ?>"></script>

    <script src="https://use.typekit.net/jtz8aoh.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>

    <header role="banner" class="c-header u-clearfix">
      <div class="o-container">
        <a class="logo u-center-block--xs u-pull-left--sm" href="#0">
          <img src="holder.js/253x88">
        </a>
        <nav role="navigation" class="c-navigation u-pull-right--sm">
          <?php wp_nav_menu( array(
            'theme_location' => 'Main Menu',
            'menu' => 'Main Menu',
            'container' => false,
            'menu_class' => 'c-menu'
          ) ); ?>
        </nav>
      </div>
    </header>

    <main role="main">