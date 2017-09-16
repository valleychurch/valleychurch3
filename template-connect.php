<?php
/*
  Template Name: Connect Groups
*/
get_header();

if (have_posts()) :
  while (have_posts()) :
    the_post(); ?>

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

<?php endwhile; else : endif; wp_reset_query(); ?>

<section class="c-section u-background-grey--11">
  <div class="o-container">
    <h2 class="u-text-center">Upcoming Connect Groups</h2>
    <div class="o-row o-row--center">
      <?php
        $meta_query = array(
          array(
            'key'     => 'signup_full',
            'value'   => "1",
            'compare' => '!=',
          )
        );

        $args =
          array(
            'post_type'       => 'connect',
            'post_status'     => array('publish', 'private'),
            'posts_per_page'  => -1,
            'orderby'         => 'meta_value',
            'order'           => 'ASC',
            'meta_key'        => 'date_start',
            'meta_query'      => $meta_query
          );

        $wp_query = new WP_Query( $args );

        if ( $wp_query->have_posts() ) :
          while ( $wp_query->have_posts() ) :
            $wp_query->the_post(); ?>

          <div class="o-col-12@xxs o-col-4@md">
            <?php get_template_part( 'partials/card', 'churchsuitegroup' ); ?>
          </div>

        <?php
          endwhile;
        // get_template_part( 'partials/pagination' );
        else:
          get_template_part( 'partials/no-content-found' );
        endif;

        wp_reset_query();
        wp_reset_postdata();
      ?>
    </div>
  </div>
</section>

<?php
// add_action( 'wp_footer', 'load_connect_groups', 50 );
get_footer();
?>
