<?php
/*
  Template Name: ChurchApp Events
*/
get_header(); ?>

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
          <h1 class="kilo u-margin-half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 class="kilo u-margin-half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?php the_title(); ?></h1>
          <?php } ?>
        </div>
        <div class="o-col-12@xxs o-col-8@sm o-col-7@md u-center-block">
          <?= get_the_content(); ?>
        </div>
      </div>

    </article>

  </section>

<?php
  // $local_location = isset( $_GET['mylocation'] ) ? $_GET['mylocation'] : 0;
  // $query_location = ( isset( $_GET['locationid'] ) ? $_GET['locationid'] : null );
  // $location_args =
  //   array(
  //     'post_type' => 'location',
  //     'post_status' => array( 'publish' ),
  //     'posts_per_page' => -1,
  //   );
  // $locations = get_posts( $location_args );
?>

  <section class="c-section u-background-grey--11">

    <form name="events-search" method="GET" action="<?= get_permalink(); ?>">

      <input type="hidden" id="mylocation" name="mylocation">

      <div class="o-container">

        <div class="o-row o-row--center">

        <?php
          // $tax_query = [];
          // $meta_query = [];
          $current_page = get_query_var( 'paged',  1 );

          // if ( isset( $query_location ) && $query_location != 0 ) {
          //   $tax_query[] =
          //     array(
          //       'taxonomy'  => 'location',
          //       'field'     => 'term_id',
          //       'terms'     => $query_location,
          //       'operator'  => 'IN',
          //     );
          // }

          $args =
            array(
              'post_type'       => 'event',
              'post_status'     => array('publish', 'private'),
              'posts_per_page'  => 12,
              'paged'           => $current_page,
              'orderby'         => 'meta_value',
              'order'           => 'ASC',
              'meta_key'        => 'datetimestamp_start',
              // 'tax_query'       => $tax_query,
              // 'meta_query'      => $meta_query,
            );

          $wp_query = new WP_Query( $args );

          if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) :
              $wp_query->the_post(); ?>

            <div class="o-col-12@xxs o-col-4@md">
              <?php get_template_part( 'partials/card', 'churchappevent' ); ?>
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
