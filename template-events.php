<?php
/*
  Template Name: Events
*/
get_header(); ?>

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
          <?= get_the_content(); ?>
        </div>
      </div>

    </article>

  </section>

<?php
  $my_location = isset( $_COOKIE['vc_location_id'] ) ? $_COOKIE['vc_location_id'] : 0;
  $query_location = ( isset( $_GET['locationid'] ) ? $_GET['locationid'] : null );
  $location_args =
    array(
      'post_type' => 'location',
      'post_status' => array( 'publish', 'private' ),
      'posts_per_page' => -1,
    );
  $locations = get_posts( $location_args );
?>

  <section class="c-section u-background-grey--11">

    <form name="events-search" method="GET" action="<?php echo get_permalink(); ?>">

      <div class="o-container">
        <div class="o-row u-margin">
          <div class="o-col-xxs-12 u-text-center">
            <p>Show me events at:</p>
            <div class="u-text-center">
              <a class="o-btn o-btn--ghost <?= ( $query_location == 0 ) ? "is-active" : ""; ?>" href="?locationid=0" role="button">
                All locations
              </a>
              <?php foreach ( $locations as $location ) { ?>
              <a class="o-btn o-btn--ghost <?= ( $query_location == $location->ID ) ? "is-active" : ""; ?>" href="?locationid=<?= $location->ID ?>" role="button">
                <?= $location->post_title ?>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <div class="o-container">

        <div class="o-row o-row--center">

        <?php
          $tax_query = [];
          $meta_query = [];
          $current_page = get_query_var( 'paged',  1 );

          if ( isset( $query_location ) && $query_location != 0 ) {
            $tax_query[] =
              array(
                'taxonomy'  => 'location',
                'field'     => 'term_id',
                'terms'     => $query_location,
                'operator'  => 'IN',
              );
          }

          $args =
            array(
              'post_type'       => 'events',
              'post_status'     => 'publish',
              'posts_per_page'  => 12,
              'paged'           => $current_page,
              'meta_query'      => $meta_query,
              'tax_query'       => $tax_query,
            );

          $wp_query = new WP_Query( $args );

          if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) :
              $wp_query->the_post(); ?>

            <div class="o-col-xxs-12 o-col-md-4">
              <?php get_template_part( 'partials/card', 'event' ); ?>
            </div>

          <?php
            endwhile;
          get_template_part( 'partials/pagination' );
          else:
            get_template_part( 'partials/no-content-found' );
          endif;

          wp_reset_query();
          wp_reset_postdata();
        ?>

        </div>

      </div>

    </form>

  </section>

<?php get_footer(); ?>
