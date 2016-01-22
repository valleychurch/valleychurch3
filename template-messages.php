<?php
/*
  Template Name: Messages
*/
get_header();
$paged = get_query_var( 'paged', 1 );
?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xs-12 c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php
        if ( !$paged || $paged == 1 )
          the_content();
        ?>

      </div>

    </article>

  </section>

  <section class="o-container c-section c-section--grey">

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
    next_posts_link( 'Older Entries' );
    previous_posts_link( 'Newer Entries' );
    else :
      get_template_part( 'no-content-found' );
    endif;
    ?>
    </div>
  </section>

<?php get_footer(); ?>