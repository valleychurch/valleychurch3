<?php get_header(); ?>

  <section class="c-banner c-banner--red" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/dist/hero-home.jpg');">
    <div class="o-container u-text-center">
      <h1 class="giga u-margin--none">Welcome Home!</h1>
      <p class="h2 u-text-light">We're so glad you're here</p>
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
        <ul class="c-slides u-cf">
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
              <source media="(min-width: 70rem)" srcset="<?php echo $img_banner[0]; ?>">
              <?php } ?>
              <?php if ( $img_banner_small ) { ?>
              <source media="(min-width: 50rem)" srcset="<?php echo $img_banner_small[0]; ?>">
              <?php } ?>
              <?php if ( $img_banner_xsmall ) { ?>
              <source srcset="<?php echo $img_banner_xsmall[0]; ?>">
              <?php } ?>
              <?php if ( $img_banner ) { ?>
              <img srcset="<?php echo $img_banner[0]; ?>" alt="<?php the_title(); ?>">
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
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/pastors.jpg">
          <div class="o-card__overlay">
            <div class="o-card__overlay__middle">
              <h2 class="o-card__title">Senior Pastors</h2>
              <p class="o-card__text u-hide u-show--lg">
                Ed &amp; Michele Carter are the Senior Pastors of Valley Church. <span class="u-hide u-show-inline--xl">They have a heart to see you empowered to fulfil all that God has for you.</span>
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
        <p class="h1"><em>"We’re not keeping this to ourselves, we’re passing it along to the next generation—God’s fame and fortune, the marvelous things he has done."</em></p>
        <a class="o-btn o-btn--ghost" href="/about">Read more about our vision</a>
      </div>
    </div>
  </section>

  <section class="o-container c-section c-section--grey">
    <div class="o-row">

      <div class="o-col-xs-12 o-col-md-4">
        <div class="o-card u-text-center">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/home-visit.jpg">
          <div class="o-card__body">
            <h2 class="o-card__title">Plan a visit</h2>
            <p class="o-card__text">
              We're one church in many locations and we'd love to see you this Sunday!
            </p>
            <a class="o-btn" href="/pastors">
              Find a location
            </a>
          </div>
        </div>
      </div>

      <div class="o-col-xs-12 o-col-md-4">
        <div class="o-card u-text-center">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/home-cg.jpg">
          <div class="o-card__body">
            <h2 class="o-card__title">Connect Groups</h2>
            <p class="o-card__text">
              Connect Groups meet in people’s homes fornightly to wwhang out, eat a meal together and chat.
            </p>
            <a class="o-btn" href="/connect">
              Find one near you
            </a>
          </div>
        </div>
      </div>

      <div class="o-col-xs-12 o-col-md-4">
        <div class="o-card u-text-center">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/home-youth.jpg">
          <div class="o-card__body">
            <h2 class="o-card__title">Valley Youth (11-18s)</h2>
            <p class="o-card__text">
              We believe in the next generation and we want to see young people live life to the full!
            </p>
            <a class="o-btn" href="/youth">
              Read more
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="o-container c-section">
    <div class="o-row">

      <div class="o-col-xs-12 o-col-md-8 u-grid-0--xs u-grid-1--md">
        <h2><a href="/thelatest">The Latest</a></h2>
        <?php
          $args =
            array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'posts_per_page' => 1
            );

          $wp_query = new WP_Query( $args );
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post(); ?>
          <div class="o-card o-card--shadow">
            <?php get_template_part( 'partials/featured-image' ); ?>
            <div class="o-card__body">
              <h3 class="o-card__title">
                <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
              <?php the_content('Read more'); ?>
            </div>
          </div>
        <?php endwhile; else : endif; ?>
        <?php wp_reset_query(); ?>
      </div>

      <div class="o-col-xs-12 o-col-md-4 u-grid-1--xs u-grid-0--md">
        <h2><a href="/messages">Messages</a></h2>
        <div class="o-row">
        <?php
          $args =
            array(
              'post_type' => 'podcast',
              'post_status' => 'publish',
              'posts_per_page' => 2
            );

          $wp_query = new WP_Query( $args );

          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post(); ?>
          <div class="o-col-xs-12 o-col-sm-6 o-col-md-12">
            <div class="o-card o-card--shadow">
              <?php get_template_part( 'partials/featured-image' ); ?>
              <div class="o-card__body">
                <h3 class="h5 o-card__title">
                  <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <?php the_content('Read more'); ?>
              </div>
            </div>
          </div>
        <?php endwhile; else : endif; ?>
        <?php wp_reset_query(); ?>
        </div>
      </div>

    </div>
  </section>

  <?php get_footer(); ?>