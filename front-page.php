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
  <section class="c-section c-section--background" style="background-image: url('/wp-content/themes/valleychurch3/assets/images/dist/home-visit.jpg');">
    <div class="o-container">
      <div class="o-row u-text-center">
        <div class="o-col-xxs-12">
          <h2 class="kilo u-margin--half u-text-white u-text-shadow">Locations</h2>
        </div>
        <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7 u-center-block">
          <p class="lead u-text-white u-line-height--small">We're one church in many locations and we'd love to see you this weekend!</p>
        </div>
      </div>
      <div class="o-row o-row--center">
        <div class="o-col-xxs-12 o-col-center o-btn-group">
        <?php while ( have_posts() ) :
          the_post(); ?>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="<?= get_permalink(); ?>" role="button"><?= the_title(); ?></a>
        <?php endwhile; ?>
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
                <a class="o-btn o-btn--ghost o-btn--ghost--white" href="<?php the_field( 'button_link' ); ?>" role="button">
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
  <section class="c-banner" style="background-image:url('<?= get_template_directory_uri(); ?>/assets/images/dist/hero-vision.jpg');">
    <div class="o-container u-text-center">
      <div class="o-container">
        <p class="kilo">
          <em>"We're not keeping this to ourselves, we're passing it along to the next generation&mdash;God's fame and fortune, the marvelous things He has done."</em>
        </p>
        <a class="o-btn o-btn--ghost o-btn--ghost--white" href="/about" role="button">Read more about our vision</a>
      </div>
    </div>
  </section>
  <!-- Section: Vision -->

  <!-- Section: Next Steps -->
  <section class="c-section c-section--background" style="background-image:url('<?= get_template_directory_uri(); ?>/assets/images/dist/home-next-steps.jpg');">
    <div class="o-container">
      <div class="o-row u-text-center">
        <div class="o-col-xxs-12">
          <h2 class="kilo u-margin--half u-text-white u-text-shadow">Next Steps</h2>
        </div>
        <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7 u-center-block">
          <p class="lead u-text-white u-line-height--small">We believe in empowering people to be all God has called them to be so want you to take the best next step possible!</p>
        </div>
      </div>
      <div class="o-row o-row--center">
        <div class="o-col-xxs-12 o-col-center o-btn-group">
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/connect" role="button">Connect Groups</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/volunteering" role="button">Volunteering</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/giving" role="button">Giving</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/teamnights" role="button">Team Nights</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/academy" role="button">Valley Academy</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/yearin" role="button">Year-In Programme</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Next Steps -->

  <!-- Section: Watch & Read -->
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
            'posts_per_page' => 4
          );

        $wp_query = new WP_Query( $args );

        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post(); ?>
        <div class="o-col-xxs-12 o-col-xs-6 o-col-md-3 o-col-lg-3 <?= ( $i > 2 ) ? "u-hide--xs u-show--md" : ""; ?>">
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
          <h2><a href="/blog">Most Recent</a></h2>
        </div>
        <?php
        $args =
          array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 2
          );
        $i = 1;

        $wp_query = new WP_Query( $args );
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post(); ?>
        <div class="o-col-xxs-12 o-col-sm-6 <?= ( $i == 2 ) ? "u-hide u-show--sm" : ""; ?>">
          <?php get_template_part( 'partials/card', 'blog' ); ?>
        </div>
        <?php $i++; ?>
        <?php endwhile; else : endif; ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>
  </section>
  <!-- Section: Watch & Read -->

  <!-- Section: People Matter -->
  <section class="c-section c-section--background" style="background-image: url('/wp-content/themes/valleychurch3/assets/images/dist/home-people-matter.jpg');">
    <div class="o-container">
      <div class="o-row u-text-center">
        <div class="o-col-xxs-12">
          <h2 class="kilo u-margin--half u-text-white u-text-shadow">People Matter</h2>
        </div>
        <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7 u-center-block">
          <p class="lead u-text-white u-line-height--small">We believe that all people matter and that the Church can make a real difference for everyone regardless of who they are, what they've done, or where they're from.</p>
        </div>
      </div>
      <div class="o-row o-row--center">
        <div class="o-col-xxs-12 o-col-center o-btn-group">
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/peoplematter" role="button">People Matter</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/community" role="button">Community Action Team</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/visionrescue" role="button">Vision Rescue</a>
          <a class="o-btn o-btn--large o-btn--ghost o-btn--ghost--white" href="/compassion" role="button">Compassion</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: People Matter -->


  <?php get_footer(); ?>
