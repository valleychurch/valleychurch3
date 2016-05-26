<?php
get_header();
$front_page_id = get_option( 'page_for_posts' );
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <h1><?= apply_filters( 'the_title', get_the_title( $front_page_id ) ); ?></h1>

          <?php
          //if ( $paged == 1 ) {
            //echo apply_filters( 'the_content', get_post_field( 'post_content', $front_page_id ) ); ?>
            <p class="lead">We're all about <a href="/about">empowering you</a> to be all that God's called you to be, so check back weekly for inspirational thoughts, blogs and messages from our Pastors and team.</p>
          <?php //} ?>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section u-background-grey--10">

    <div class="o-container">

      <div class="o-row">

        <div class="c-post-content--wide u-center-block">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <div class="o-col-xxs-12">
            <?php get_template_part( 'partials/card', 'blog' ); ?>
          </div>

        <?php
        endwhile;
        get_template_part( 'partials/pagination' );
        else :
          get_template_part( 'no-content-found' );
        endif;
        ?>
        </div>

      </div>

    </div>

  </section>

<?php get_footer(); ?>
