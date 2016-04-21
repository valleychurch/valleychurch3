<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

  <head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-57x57.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-60x60.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-72x72.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-76x76.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-114x114.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-120x120.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-144x144.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-152x152.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/valleychurch3/assets/favicons/apple-touch-icon-180x180.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="icon" type="image/png" href="/wp-content/themes/valleychurch3/assets/favicons/favicon-32x32.png?v=<?= VC_THEME_VERSION ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="/wp-content/themes/valleychurch3/assets/favicons/favicon-194x194.png?v=<?= VC_THEME_VERSION ?>" sizes="194x194">
    <link rel="icon" type="image/png" href="/wp-content/themes/valleychurch3/assets/favicons/favicon-96x96.png?v=<?= VC_THEME_VERSION ?>" sizes="96x96">
    <link rel="icon" type="image/png" href="/wp-content/themes/valleychurch3/assets/favicons/android-chrome-192x192.png?v=<?= VC_THEME_VERSION ?>" sizes="192x192">
    <link rel="icon" type="image/png" href="/wp-content/themes/valleychurch3/assets/favicons/favicon-16x16.png?v=<?= VC_THEME_VERSION ?>" sizes="16x16">
    <link rel="manifest" href="/wp-content/themes/valleychurch3/assets/favicons/manifest.json?v=<?= VC_THEME_VERSION ?>">
    <link rel="mask-icon" href="/wp-content/themes/valleychurch3/assets/favicons/safari-pinned-tab.svg?v=<?= VC_THEME_VERSION ?>" color="#b21e28">
    <meta name="msapplication-TileColor" content="#b21e28">
    <meta name="msapplication-TileImage" content="/wp-content/themes/valleychurch3/assets/favicons/mstile-144x144.png?v=<?= VC_THEME_VERSION ?>">
    <meta name="theme-color" content="#b21e28">

    <!-- Prefetch some DNS -->
    <link rel="dns-prefetch" href="//cdn.valleychurch.eu">
    <link rel="dns-prefetch" href="//use.typekit.net">

    <!-- Pingback URL -->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Load Typekit ASAP -->
    <script src="//use.typekit.net/jtz8aoh.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!-- IE fixes -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/assets/scripts/dist/respond.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/assets/scripts/dist/rem.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <!--[if lt IE 9]><div class="o-container o-container--full c-browse-happy">
    <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    </div><![endif]-->

    <?php if( $_SERVER['HTTP_HOST'] === "test.valleychurch.eu" ) { ?>
    <div class="o-container o-container--full c-browse-happy u-text-center">
      <p class="h2">Test environment</p>
    </div>
    <?php } ?>

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
            <button class="o-btn c-nav-toggle js-nav-toggle">
              <span class="u-hide u-show-inline--xs">Menu</span>&nbsp;&nbsp;<i class="fa fa-lg fa-bars"></i>
            </button>
          </div>
        </div>
      </header>

      <main class="c-main">
