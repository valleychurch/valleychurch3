<?php
/*
  Template Name: Messages
*/
get_header();
$paged = get_query_var( 'paged', 1 );
?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row u-text-center">

        <div class="o-col-12@xxs">
          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 class="kilo u-margin--half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 class="kilo u-margin--half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?php the_title(); ?></h1>
          <?php } ?>
        </div>

        <div class="o-col-12@xxs o-col-8@sm o-col-7@md u-center-block">
          <p class="lead u-margin u-margin-double@md">
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

        <div class="o-col-6@xs o-col-4@md o-col-3@lg">
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
