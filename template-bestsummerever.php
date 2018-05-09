<?php
/*
  Template Name: Best Summer Ever 2018
 */
get_header();
?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>
          <?php } ?>

          <?php the_content(); ?>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section">
    <div class="o-container">
      <div class="o-row o-row--center">
        <?php
        $args =
          array(
          'post_type' => 'bestsummerever',
          'post_status' => array('publish'),
          'posts_per_page' => -1,
          'orderby' => 'meta_value',
          'order' => 'ASC',
          'meta_key' => 'date_start'
        );

        $wp_query = new WP_Query($args);

        if ($wp_query->have_posts()) :
          while ($wp_query->have_posts()) :
          $wp_query->the_post(); ?>

            <div class="o-col-12@xxs o-col-6@sm o-col-3@md">
              <?php get_template_part('partials/card', 'bestsummerever'); ?>
            </div>

          <?php
          endwhile;
          else :
            get_template_part('partials/no-groups-found');
          endif;
          ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
