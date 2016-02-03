<?php get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xxs-12 c-post-content u-center-block">

        <h1>Sorry, we can't find the page you're looking for!</h1>

        <p class="lead">You can either use the search below, or <a href="/">head back to the home page</a>.</p>

        <?php get_search_form(); ?>

      </div>

    </article>

  </section>

<?php get_footer(); ?>