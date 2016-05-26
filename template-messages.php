<?php
/*
  Template Name: Messages
*/
get_header();
$paged = get_query_var( 'paged', 1 );
?>

  <?php
  set_query_var( 'class', 'c-featured' );
  get_template_part( 'partials/hero', 'banner' );
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

          <?php
          if ( !$paged || $paged == 1 )
            the_content();
          ?>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section u-background-grey--10">

    <div class="o-container">

      <div class="o-row">
      <?php
        $args =
          array(
            'post_type' => 'podcast',
            'post_status' => 'publish',
            'paged' => $paged,
            'posts_per_page' => 12
          );

        $wp_query = new WP_Query( $args );
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="o-col-xs-6 o-col-md-4 o-col-lg-3">
          <?php get_template_part( 'partials/card', 'message' ); ?>
        </div>
      <?php
      endwhile;
      get_template_part( 'partials/pagination' );
      else :
        get_template_part( 'partials/no-content-found' );
      endif;
      ?>
      </div>

    </div>

  </section>

<?php get_footer(); ?>
