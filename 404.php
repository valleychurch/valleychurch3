<?php get_header(); ?>

  <section class="c-section c-section--hero">
    <?php get_template_part( 'partials/hero', 'banner' ); ?>
  </section>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1>Sorry, we can't find the page you're looking for!</h1>

        <p class="lead">Either use the search below, or <a href="/">head back to the home page</a>.</p>

        <?php get_search_form(); ?>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
