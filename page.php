<?php get_header(); ?>

      <?php get_template_part( 'partials/featured-image' ); ?>

      <article <?php post_class( 'o-container' ); ?> role="article">

        <div class="o-row">

          <div class="o-col-xs-12 o-col-md-7 c-post-content u-center-block">

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

          </div>

        </div>

      </article>

<?php get_footer(); ?>