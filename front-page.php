<?php
  get_header();

  $featured = get_template_directory_uri() . '/assets/images/dist/hero-home.jpg';
  if ( has_post_thumbnail() ) {
    $featured = get_the_post_thumbnail( $post, 'slide' );
  }
?>

  <section class="c-banner c-banner--red" style="background-image:url('<?= $featured; ?>');">
    <div class="o-container u-text-center">
    <?php if ( !empty( get_the_content() ) ) {
      the_content();
    } else { ?>
      <h1 class="giga u-margin--none">Welcome Home!</h1>
      <p class="h2 u-text-light">We're glad you're here</p>
    <?php } ?>
    </div>
  </section>

  <section class="o-container c-section">
    <div class="o-row">
    <?php
      $args =
        array(
          'post_type' => 'slider',
          'post_status' => 'publish',
          'posts_per_page' => -1
        );

      $wp_query = new WP_Query( $args );
      if ( have_posts() ) : ?>
      <div class="o-col-xxs-12 o-col-md-6">
        <div class="c-slide-container">
          <ul class="c-slides u-margin u-margin-md--none u-cf">
          <?php while ( have_posts() ) :
            the_post();
            if ( has_post_thumbnail() ) :
              $img_id = get_post_thumbnail_id( $post->ID );
              $img_banner = wp_get_attachment_image_src( $img_id, 'slide' );
              $img_banner_medium = wp_get_attachment_image_src( $img_id, 'slide-medium' );
              $img_banner_small = wp_get_attachment_image_src( $img_id, 'slide-small' );
          ?>
            <li class="o-slide">
              <?php if ( get_field('slider_link') ) { ?><a href="<?php the_field( "slider_link" ); ?>"><?php } ?>
              <picture>
                <?php if ( $img_banner_small ) { ?>
                <source media="(min-width: 60rem)" srcset="<?= $img_banner_small[0]; ?>">
                <?php }
                if ( $img_banner_medium ) { ?>
                <source media="(min-width: 40rem)" srcset="<?= $img_banner_medium[0]; ?>">
                <?php }
                if ( $img_banner_small ) { ?>
                <source srcset="<?= $img_banner_small[0]; ?>">
                <?php }
                if ( $img_banner_small ) { ?>
                <img srcset="<?= $img_banner_small[0]; ?>" alt="<?php the_title(); ?>" width="<?= $img_banner_small[1]; ?>" height="<?= $img_banner_small[2]; ?>">
                <?php } ?>
              </picture>
              <?php if ( get_field('slider_link') ) { ?></a><?php } ?>
            </li>
          <?php endif;
          endwhile; ?>
          </ul>
          <div class="slide-control"></div>
        </div>
      </div>
    <?php else : endif; ?>
    <?php wp_reset_query(); ?>
    <?php if ( get_field( 'show_panel' ) == 1 ) { ?>
      <div class="o-col-xxs-12 o-col-md-6">
        <div class="o-card o-card--overlay">
          <?php if ( get_field( 'image' ) ) {
            set_query_var( 'image_id', get_field('image')["id"] );
            get_template_part( 'partials/featured-image', 'simple' );
          }
          ?>
          <div class="o-card__overlay">
            <div class="o-card__overlay__middle">
            <?php if ( get_field( 'title' ) ) { ?>
              <h2 class="o-card__title"><?= get_field( 'title' ); ?></h2>
            <?php } ?>
            <?php if ( get_field( 'content' ) ) { ?>
              <p class="o-card__text u-hide u-show--sm u-hide--md u-show--xl">
              <?= get_field( 'content' ); ?>
              </p>
            <?php } ?>
            <?php if ( get_field( 'show_button' ) == 1 ) { ?>
              <a class="o-btn o-btn--ghost" href="<?php the_field( 'button_link' ); ?>">
                <?= get_field( 'button_text' ); ?>
              </a>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </section>

  <section class="c-banner" style="background-image:url('<?= get_template_directory_uri(); ?>/assets/images/dist/hero-vision.jpg'); ">
    <div class="o-container u-text-center">
      <div class="o-container o-container--sm">
        <p class="h1 u-hide u-show--sm"><em>"We're not keeping this to ourselves, we're passing it along to the next generation&mdash;God's fame and fortune, the marvelous things He has done."</em></p>
        <p class="h3 u-hide--sm"><em>"We're not keeping this to ourselves, we're passing it along to the next generation&mdash;God's fame and fortune, the marvelous things He has done."</em></p>
        <a class="o-btn o-btn--ghost" href="/about">Read more about our vision</a>
      </div>
    </div>
  </section>

  <?php
  $i = 1;
  if ( have_rows( 'home_page_cards' ) ) : ?>
  <section class="o-container c-section c-section--grey">
    <div class="o-row">
    <?php while ( have_rows( 'home_page_cards' ) ) :
      the_row(); ?>

      <div class="<?php ($i > 1) ? print "o-col-xxs-12 o-col-sm-6 o-col-lg-4" : print "o-col-xxs-12 o-col-sm-12 o-col-lg-4"; ?>">
        <div class="o-card u-text-center">
          <?php if ( get_sub_field( 'image' ) ) {
            set_query_var( 'image_id', get_sub_field( 'image' )["id"] );
            set_query_var( 'class', 'o-card__img' );
            get_template_part( 'partials/featured-image', 'slide' );
          } ?>

          <?php if ( get_sub_field( 'title' ) || get_sub_field( 'content' ) ) { ?>
          <div class="o-card__body">

            <?php if ( get_sub_field( 'title' ) ) { ?>
            <h2 class="h3 o-card__title"><?= get_sub_field( 'title' ); ?></h2>
            <?php } ?>

            <?php if ( get_sub_field( 'content' ) ) { ?>
            <p class="o-card__text">
              <?= get_sub_field( 'content' ); ?>
            </p>
            <?php } ?>

            <?php if ( get_sub_field( 'show_button' ) == 1 ) { ?>
            <a class="o-btn" href="<?php the_sub_field( 'button_link' ); ?>">
              <?php if ( get_sub_field( 'button_text' ) ) {
                echo get_sub_field( 'button_text' );
              } ?>
            </a>
            <?php } ?>

          </div>
          <?php } ?>

        </div>
      </div>

    <?php
    $i++;
    endwhile;
    ?>
    </div>
  </section>
  <?php
  else :
    // get_template_part( 'partials/no-content-found' );
  endif; ?>

  <section class="o-container c-section">
    <div class="o-row">
      <div class="o-col-xxs-12">
        <h2><a href="/messages">Messages</a></h2>
      </div>
      <?php
      $i = 1;
      $args =
        array(
          'post_type' => 'podcast',
          'post_status' => 'publish',
          'posts_per_page' => 6
        );

      $wp_query = new WP_Query( $args );

      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post(); ?>
      <div class="o-col-xs-6 o-col-md-4 o-col-lg-3 <?php ( $i > 4 ) ? print "u-hide--lg" : ""; ?>">
        <?php get_template_part( 'partials/card', 'message' ); ?>
      </div>
      <?php
      $i++;
      endwhile;
      else :
        get_template_part( 'partials/no-content-found' );
      endif;
      wp_reset_query(); ?>
    </div>
  </section>

  <section class="o-container c-section">
    <div class="o-row">
      <div class="o-col-xxs-12">
        <h2><a href="/thelatest">The Latest</a></h2>
      </div>
      <?php
      $args =
        array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => 2
        );

      $wp_query = new WP_Query( $args );
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post(); ?>
      <div class="o-col-xxs-12 o-col-sm-6">
        <?php get_template_part( 'partials/card', 'blog' ); ?>
      </div>
      <?php endwhile; else : endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </section>

  <?php get_footer(); ?>
