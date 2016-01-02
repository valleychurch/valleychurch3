<?php get_header(); ?>

  <div class="c-banner c-banner--red u-margin" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/dist/hero-home.jpg'); ">
    <div class="o-container u-text-center">
      <h1 class="giga u-margin--none">Welcome Home!</h1>
      <p class="h2">We're so glad you're here</p>
      <!-- <a class="o-btn o-btn--ghost" href="/about">Find out more about Valley</a> -->
    </div>
  </div>

  <div class="o-container">
    <div class="o-row">
    <?php
      $args =
      array(
        'post_type' => 'slider',
        'post_status' => 'publish',
        'posts_per_page' => -1
      );

      $slides = new WP_Query( $args );
      if ( $slides->have_posts() ) : ?>
      <div class="o-col-xs-12 o-col-md-6">
        <ul class="c-slides u-margin u-cf">
        <?php while ( $slides->have_posts() ) :
          $slides->the_post();
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
    <?php endif; ?>
      <div class="o-col-xs-12 o-col-md-6">
        <div class="o-card o-card--overlay">
          <img class="o-card__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/dist/pastors.jpg">
          <div class="o-card__overlay">
            <div class="o-card__overlay__middle">
              <h2 class="o-card__title">Senior Pastors</h2>
              <p class="o-card__text u-show u-hide--md u-show--lg">
                Ed &amp; Michele Carter are the Senior Pastors of Valley Church. They have a heart to see you empowered to fulfil all that God has for you.
              </p>
              <a class="o-btn o-btn--ghost" href="/pastors">
                Read more
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-banner u-margin" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/dist/hero-home.jpg'); ">
    <div class="o-container u-text-center">
      <div class="o-container o-container--sm">
        <p class="h1"><em>"We will tell the next generation the praiseworthy deeds of the Lord, his power, and the wonders he has done."</em></p>
        <a class="o-btn o-btn--ghost" href="/about">Find out more about our vision</a>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>