<?php
  get_header();

  $featured = get_template_directory_uri() . '/assets/images/dist/hero-home.jpg';
  if ( has_post_thumbnail() ) {
    $featured = get_the_post_thumbnail( $post, 'slide' );
  }
?>

  <section class="c-banner c-banner--red" style="background-image:url('<?php echo $featured; ?>');">
    <div class="o-container u-text-center">
      <h1 class="giga u-margin--none">Welcome Home!</h1>
      <p class="h2 u-text-light">We're glad you're here</p>
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
      <div class="o-col-xs-12 o-col-md-6">
        <ul class="c-slides u-margin u-margin-md--none u-cf">
        <?php while ( have_posts() ) :
          the_post();
          if ( has_post_thumbnail() ) :
            $img_id = get_post_thumbnail_id( $post->ID );
            $img_banner = wp_get_attachment_image_src( $img_id, 'slide' );
            $img_banner_small = wp_get_attachment_image_src( $img_id, 'slide-small' );
            $img_banner_xsmall = wp_get_attachment_image_src( $img_id, 'slide-xsmall' );
        ?>
          <li class="o-slide">
            <?php if ( get_field('slider_link') ) { ?><a href="<?php the_field( "slider_link" ); ?>"><?php } ?>
            <picture>
              <?php if ( $img_banner ) { ?>
              <source media="(min-width: 60rem)" srcset="<?php echo $img_banner[0]; ?>">
              <?php } ?>
              <?php if ( $img_banner_small ) { ?>
              <source media="(min-width: 40rem)" srcset="<?php echo $img_banner_small[0]; ?>">
              <?php } ?>
              <?php if ( $img_banner_xsmall ) { ?>
              <source srcset="<?php echo $img_banner_xsmall[0]; ?>">
              <?php } ?>
              <?php if ( $img_banner ) { ?>
              <img srcset="<?php echo $img_banner[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $img_banner[1]; ?>" height="<?php echo $img_banner[2]; ?>">
              <?php } ?>
            </picture>
            <?php if ( get_field('slider_link') ) { ?></a><?php } ?>
          </li>
        <?php endif;
        endwhile; ?>
        </ul>
        <div class="slide-control"></div>
      </div>
    <?php else : endif; ?>
    <?php wp_reset_query(); ?>
      <div class="o-col-xs-12 o-col-md-6">
        <div class="o-card o-card--overlay">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/pastors.jpg" width="1280" height="720">
          <div class="o-card__overlay">
            <div class="o-card__overlay__middle">
              <h2 class="o-card__title">Senior Pastors</h2>
              <p class="o-card__text u-hide u-show--sm u-hide--md u-show--lg">
                Ed &amp; Michele Carter are the Senior Pastors of Valley Church. <span class="u-hide u-show--sm u-hide--md u-show-inline--xl">They have a heart to see you empowered to fulfil all that God has for you.</span>
              </p>
              <a class="o-btn o-btn--ghost" href="/pastors">
                Read more
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="c-banner" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/dist/hero-vision.jpg'); ">
    <div class="o-container u-text-center">
      <div class="o-container o-container--sm">
        <p class="h1"><em>"We're not keeping this to ourselves, we're passing it along to the next generation—God's fame and fortune, the marvelous things he has done."</em></p>
        <a class="o-btn o-btn--ghost" href="/about">Read more about our vision</a>
      </div>
    </div>
  </section>

  <section class="o-container c-section c-section--grey">
    <div class="o-row">

      <div class="o-col-xs-12 o-col-md-12 o-col-xl-4">
        <div class="o-card u-text-center">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/home-visit.jpg" width="1280" height="720">
          <div class="o-card__body">
            <h2 class="h3 o-card__title">Plan a visit</h2>
            <p class="o-card__text">
              We're one church in many locations and we'd love to see you this Sunday!
            </p>
            <a class="o-btn" href="/pastors">
              Find a location
            </a>
          </div>
        </div>
      </div>

      <div class="o-col-xs-12 o-col-md-6 o-col-xl-4">
        <div class="o-card u-text-center">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/home-cg.jpg" width="1280" height="720">
          <div class="o-card__body">
            <h2 class="h3 o-card__title">Connect Groups</h2>
            <p class="o-card__text">
              Connect Groups meet in homes fortnightly to hang out, eat a meal together and chat.
            </p>
            <a class="o-btn" href="/connect">
              Find one near you
            </a>
          </div>
        </div>
      </div>

      <div class="o-col-xs-12 o-col-md-6 o-col-xl-4">
        <div class="o-card u-text-center">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/home-youth.jpg" width="1280" height="720">
          <div class="o-card__body">
            <h2 class="h3 o-card__title">Valley Youth (11-18s)</h2>
            <p class="o-card__text">
              We believe in empowering a new generation and want to see young people live life to the full!
            </p>
            <a class="o-btn" href="/youth">
              Get involved
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="o-container c-section">
    <div class="o-row">
      <div class="o-col-xs-12">
        <h2><a href="/messages">Messages</a></h2>
      </div>
      <?php
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
        <div class="o-col-xs-12 o-col-sm-6 o-col-lg-3">
          <div class="o-card o-card--shadow">
            <?php get_template_part( 'partials/featured-image-simple' ); ?>
            <div class="o-card__body">
              <h3 class="h4 o-card__title u-margin--none">
                <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
              <?php //the_content('Read more'); ?>
            </div>
          </div>
        </div>
      <?php endwhile; else : endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </section>

  <section class="o-container c-section">
    <div class="o-row">
      <div class="o-col-xs-12">
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
      <div class="o-col-xs-12 o-col-sm-6">
        <div class="o-card o-card--shadow">
          <?php get_template_part( 'partials/featured-image' ); ?>
          <div class="o-card__body">
            <h3 class="h1 o-card__title">
              <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </h3>
            <div class="o-flag u-margin--double">
              <div class="o-flag__fix">
                <?php get_template_part( 'partials/avatar' ); ?>
              </div>
              <div class="o-flag__flex">
                <p class="u-margin--none">
                  <?php the_author(); ?>
                </p>
                <p class="small u-text-muted u-margin--none">
                  <strong>
                    <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
                  </strong>
                </p>
              </div>
            </div>
            <?php the_content('Read more'); ?>
            <p class="u-margin--none">
              <?php comments_popup_link(); ?>
            </p>
          </div>
        </div>
      </div>
      <?php endwhile; else : endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </section>

  <?php get_footer(); ?>