<?php
get_header();
$front_page_id = get_option( 'page_for_posts' );
$paged = get_query_var( 'paged', 1 );
?>

  <?php
  set_query_var( 'front_page_id', (int) $front_page_id );
  get_template_part( 'partials/featured-image' );
  ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xs-12 c-post-content u-center-block">

        <h1><?php echo apply_filters( 'the_title', get_the_title( $front_page_id ) ); ?></h1>

        <?php
        if ( $paged == 1 ) ?>
          //echo apply_filters( 'the_content', get_post_field( 'post_content', $front_page_id ) );
          <p>We're all about <a href="/about">empowering you to be all that God's called you to be</a>, so check back weekly for inspirational thoughts, blogs and messages from our Pastors and team.</p>
        <?php } ?>

      </div>

    </article>

  </section>

  <section class="o-container c-section c-section--grey">

    <div class="o-row">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="o-col-xs-12 o-col-md-6">
        <?php get_template_part( 'partials/card', 'blog' ); ?>
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