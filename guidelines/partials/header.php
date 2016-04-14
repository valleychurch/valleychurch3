<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/dist/touchicon.png">
    <link rel="icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/dist/favicon.png">
    <!--[if IE]><link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/dist/favicon.ico"><![endif]-->
    <!-- or, set /favicon.ico for IE10 win -->
    <meta name="msapplication-TileImage" content="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/dist/tileicon.png">
    <meta name="msapplication-TileColor" content="#b21e28">
    <meta name="msapplication-navbutton-color" content="#b21e28">
    <meta name="theme-color" content="#b21e28">

    <title>Development Guidelines</title>

    <link rel="dns-prefetch" href="//cdn.valleychurch.eu">
    <link rel="dns-prefetch" href="//use.typekit.net">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Inline Critical CSS -->
    <style><?= file_get_contents( get_template_directory_uri() . '/assets/styles/css/critical.min.css' ); ?></style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/prism/1.4.1/themes/prism.min.css"/>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/styles/css/style.<?= VC_THEME_VERSION; ?>.min.css" />

    <!-- Load Typekit (EARLY!) -->
    <script src="//use.typekit.net/jtz8aoh.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script src="<?= get_template_directory_uri(); ?>/assets/scripts/dist/jquery.min.js>"></script>
    <script src="<?= get_template_directory_uri(); ?>/assets/scripts/dist/script.<?= VC_THEME_VERSION; ?>.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prism/1.4.1/prism.min.js"></script>

    <!-- IE fixes -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/assets/scripts/dist/respond.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/assets/scripts/dist/rem.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="o-container o-container--page">

      <a class="c-navigation--toggle js-nav-toggle" href="#0"></a>

      <header class="c-header u-clearfix">
        <div class="o-container o-container--full">
          <a class="logo u-pull-left" href="/wp-content/themes/valleychurch3/guidelines">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/dist/icon.svg" width="32" height="32">
          </a>

          <nav class="c-navigation u-cf">
            <div class="u-pull-left--lg">
              <ul class="c-menu u-cf">
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "getstarted" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="getstarted">Get Started</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "tools" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="tools">Tools</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "settings" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="settings">Settings</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "generic" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="generic">Generic</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "base" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="base">Base</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "objects" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="objects">Objects</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "components" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="components">Components</a>
                </li>
                <li class="menu-item <?= basename( $_SERVER['PHP_SELF'], '.php' ) == "trumps" ? 'current-menu-parent current-menu-item' : ''; ?>">
                  <a href="trumps">Trumps</a>
                </li>
              </ul>
            </div>
          </nav>

          <!-- <div class="u-pull-right u-hide--lg">
            <button class="o-btn c-nav-toggle js-nav-toggle">
              <span class="u-hide u-show-inline--xs">Menu</span>&nbsp;&nbsp;<i class="fa fa-lg fa-bars"></i>
            </button>
          </div> -->
        </div>
      </header>

      <main class="c-main">
