<?php get_header(); ?>

  <section class="c-section c-section--hero">
    <?php get_template_part( 'partials/hero', 'banner' ); ?>
  </section>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

        <?php get_template_part( 'partials/sharer' ); ?>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
