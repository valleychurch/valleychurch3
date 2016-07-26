<?php get_header(); ?>

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

          <h1>Sorry, we can't find the page you're looking for!</h1>

          <p class="lead">Either use the search below, or <a href="/">head back to the home page</a>.</p>

          <?php get_search_form(); ?>

        </div>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
