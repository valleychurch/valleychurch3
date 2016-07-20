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
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png?v=<?= VC_THEME_VERSION ?>">
    <link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png?v=<?= VC_THEME_VERSION ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/favicons/favicon-16x16.png?v=<?= VC_THEME_VERSION ?>" sizes="16x16">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/assets/favicons/manifest.json?v=<?= VC_THEME_VERSION ?>">
    <link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/assets/favicons/safari-pinned-tab.svg?v=<?= VC_THEME_VERSION ?>" color="<?= ( get_field( 'meta_colour' ) ? get_field( 'meta_colour' ) : '#b21e28' ) ?>">
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/favicons/favicon.ico?v=<?= VC_THEME_VERSION ?>">
    <meta name="msapplication-config" content="<?= get_template_directory_uri(); ?>/assets/favicons/browserconfig.xml?v=<?= VC_THEME_VERSION ?>">
    <meta name="theme-color" content="<?= ( get_field( 'meta_colour' ) ? get_field( 'meta_colour' ) : '#b21e28' ) ?>">

    <!-- Prefetch some DNS -->
    <link rel="dns-prefetch" href="//cdn.valleychurch.eu">
    <link rel="dns-prefetch" href="//use.typekit.net">

<?php
if ( is_singular() ) {
  if ( have_rows( 'meta_tags' ) ) { ?>
    <!-- Add some prefetches/prerenders from the CMS -->
<?php
    while ( have_rows( 'meta_tags' ) ) {
      the_row();
?>
    <link rel="<?= get_sub_field( 'prefetch_type' ) ?>" href="<?= get_sub_field( 'resource_url' ) ?>">
<?php
    }
  }
}
if ( is_home() || is_page('messages') ) {
  $next = get_next_posts_link();
?>
    <!-- Add some prefetches/prerenders from the CMS -->
    <link rel="prefetch" href="<?= get_next_posts_page_link() ?>">
    <link rel="prerender" href="<?= get_next_posts_page_link() ?>">
<?php } ?>

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

    <a class="c-navigation--toggle js-nav-toggle" href="#0"></a>

    <header class="c-header u-cf">

      <?php get_template_part( 'partials/notification' ); ?>

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
            <i class="fa fa-lg fa-bars"></i>
          </button>
        </div>
      </div>
    </header>

    <main class="c-main">
