<?php
  get_header();

  $featured = get_template_directory_uri() . '/assets/images/dist/hero-home.jpg';
  if ( has_post_thumbnail() ) {
    $featured = get_the_post_thumbnail( $post, 'slide' );
  }
?>

  <!-- Section: Welcome -->
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
  <!-- Section: Welcome -->

  <?php
    $args =
      array(
        'post_type' => 'location',
        'post_status' => 'publish',
        'posts_per_page' => -1
      );

    $wp_query = new WP_Query( $args );
    if ( have_posts() ) : ?>
  <!-- Section: Locations -->
  <section class="c-section c-section--grey">
    <div class="o-container">
      <div class="o-row">
        <div class="o-col-xxs-12 u-text-center">
          <h2 class="kilo u-margin--half">Locations</h2>
          <p class="lead">We're one church in many locations and we'd love to see you this weekend!</p>
        </div>
      </div>
      <div class="o-row">
      <?php while ( have_posts() ) :
        the_post(); ?>
        <div class="o-col-xxs-12 o-col-md-4">
          <?php get_template_part( 'partials/card', 'location' ); ?>
        </div>
      <?php endwhile; ?>
      </div>
      <div class="o-row">
        <div class="o-col-xxs-12 u-text-center">
          <a class="o-btn o-btn--large u-margin" href="/locations" role="button">View all locations</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Locations -->
  <?php endif; ?>
  <?php wp_reset_query(); ?>

  <!-- Section: Church Life -->
  <section class="c-section">
    <div class="o-container">
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
                  <?php if ( $img_banner_small || $img_banner_medium ) { ?>
                  <!--[if IE 9]><video style="display: none;"><![endif]-->
                  <?php }
                  //if ( $img_banner_medium ) { ?>
                  <!-- <source media="(min-width: 60rem)" srcset="<?= $img_banner_medium[0]; ?>"> -->
                  <?php //}
                  if ( $img_banner_medium ) { ?>
                  <source media="(min-width: 40rem)" srcset="<?= $img_banner_medium[0]; ?>">
                  <?php }
                  if ( $img_banner_small ) { ?>
                  <source srcset="<?= $img_banner_small[0]; ?>">
                  <?php }
                  if ( $img_banner_small || $img_banner_medium ) { ?>
                  <!--[if IE 9]></video><![endif]-->
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
                <a class="o-btn o-btn--ghost" href="<?php the_field( 'button_link' ); ?>" role="button">
                  <?= get_field( 'button_text' ); ?>
                </a>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </section>
  <!-- Section: Church Life -->

  <!-- Section: Vision -->
  <section class="c-banner" style="background-image:url('<?= get_template_directory_uri(); ?>/assets/images/dist/hero-vision.jpg'); ">
    <div class="o-container u-text-center">
      <div class="o-container">
        <p class="kilo">
          <em>"We're not keeping this to ourselves, we're passing it along to the next generation&mdash;God's fame and fortune, the marvelous things He has done."</em>
        </p>
        <a class="o-btn o-btn--ghost" href="/about" role="button">Read more about our vision</a>
      </div>
    </div>
  </section>
  <!-- Section: Vision -->

  <!-- Section: Next Steps -->
  <section class="c-section c-section--grey">
    <div class="o-container">
      <div class="o-row u-text-center">
        <div class="o-col-xxs-12">
          <h2 class="u-margin--half">Next Steps</h2>
          <h3 class="u-alt">We believe in empowering people to be all God has called them to be so want you to take the best next step possible!</h3>
        </div>
      </div>
      <div class="o-row u-text-center">
      </div>
    </div>
  </section>
  <!-- Section: Next Steps -->

  <!-- Section: People Matter -->
  <section class="c-section c-section--background" style="background-image: url('/wp-content/themes/valleychurch3/assets/images/dist/home-people-matter.jpg');">
    <div class="o-container">
      <div class="o-row u-text-center u-text-white">
        <div class="o-col-xxs-12">
          <h2 class="u-margin--half">People Matter</h2>
          <p>We believe that all people matter and that the Church can make a real difference for everyone regardless of who they are, what they've done, or where they're from.</p>
        </div>
      </div>
      <div class="o-row u-text-center">
        <a class="o-btn o-btn--large o-btn--ghost" href="/peoplematter" role="button">People Matter</a>
        <a class="o-btn o-btn--large o-btn--ghost" href="/community" role="button">Community Action Team</a>
        <a class="o-btn o-btn--large o-btn--ghost" href="/visionrescue" role="button">Vision Rescue</a>
        <a class="o-btn o-btn--large o-btn--ghost" href="/compassion" role="button">Compassion</a>
      </div>
    </div>
  </section>
  <!-- Section: People Matter -->

  <section class="c-section">
    <div class="o-container">
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
        <div class="o-col-xxs-12 o-col-xs-6 o-col-md-4 o-col-lg-3 <?= ( $i > 4 ) ? "u-hide--lg" : ""; ?>">
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
    </div>
  </section>

  <section class="c-section">
    <div class="o-container">
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
    </div>
  </section>

  <?php get_footer(); ?>
