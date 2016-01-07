<?php
/*
  Template Name: Events
*/
get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?> role="article">

      <div class="o-col-xs-12 c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <section class="o-container c-section c-section--grey">
    <div class="o-row">
    <?php
      $args =
        array(
          'post_type' => 'events',
          'post_status' => 'publish',
          'posts_per_page' => -1
        );

      $wp_query = new WP_Query( $args );
      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <div class="o-col-xs-12 o-col-md-4">

        <div class="o-card o-card--shadow">
          <?php if ( has_post_thumbnail() ) { ?>
          <div class="o-card__image"><?php the_post_thumbnail(); ?></div>
          <?php } ?>
          <div class="o-card__body">
            <h2 class="o-card__title">
              <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>
            <?php if ( get_field( 'event_date' ) ) { ?>
            <p class="o-card__text lead">
              <?php if ( get_field( 'event_time' ) ) {
                echo get_field( 'event_date' ) . ', ' . get_field( 'event_time' );
              } else {
                the_field( 'event_date' );
              } ?>
            </p>
            <?php
            }
            if ( get_field( 'event_venue' ) ) { ?>
            <p class="o-card__text">
              Held at:
              <?php if ( get_field( 'event_map_link' ) ) { ?>
                <a href="<?php the_field( 'event_map_link' ); ?>" target="_blank">
                  <?php the_field( 'event_venue' ); ?>
                </a>
              <?php } else {
                the_field( 'event_venue' );
              } ?>
            </p>
          <?php } ?>
          </div>
        </div>

      </div>

    <?php endwhile; else : endif; ?>
    </div>
  </section>

<?php get_footer(); ?>