<?php
/*
  Template Name: Messages
*/
get_header();
$paged = get_query_var( 'paged', 1 );
?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'class', 'c-featured' );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row u-text-center">
        <div class="o-col-xxs-12">
          <h1 class="kilo u-margin--half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?php the_title(); ?></h1>
        </div>
        <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7 u-center-block">
          <p class="lead u-margin u-margin--md--double">
            <?php
          if ( !$paged || $paged == 1 )
            the_content();
          ?>
          </p>
        </div>
      </div>

    </article>

  </section>

  <section class="c-section u-background-grey--11">

    <div class="o-container">

      <div class="o-row">
      <?php
        $args =
          array(
            'post_type' => 'podcast',
            'post_status' => array( 'publish', 'private' ),
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
