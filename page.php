<?php get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="c-section o-container">

    <article <?php post_class( 'o-row c-article u-margin' ); ?> role="article">

      <div class="o-col-xs-12 c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

<?php get_footer(); ?>