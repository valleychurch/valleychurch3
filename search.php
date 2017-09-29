<?php get_header(); ?>

  <?php //get_template_part( 'partials/featured-image' ); ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <h1>Showing search results for <em><?php the_search_query(); ?></em></h1>

        </div>

      </div>

    </article>

  </section>

  <?php if ( have_posts() ) : ?>

  <section class="c-section u-background-grey--11">

    <div class="o-container">

      <div class="o-row">
      <?php while ( have_posts() ) : the_post(); ?>

        <div class="o-col-12@xxs">
          <div class="o-row u-margin-double">
            <div class="o-col-12@xxs o-col-5@sm o-col-4@md o-col-3@lg u-margin">
            <?php if ( has_post_thumbnail() ) {
              the_post_thumbnail();
            } ?>
            </div>
            <div class="o-col-12@xxs o-col-7@sm o-col-8@md o-col-9@lg">
              <h2 class="u-margin--half"><a href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>"><?php the_title(); ?></a></h2>
              <p class="u-text-muted"><em><?= str_replace( 'https://', '', get_permalink() ); ?></em></p>
              <?php the_excerpt(); ?>
              <a class="o-btn" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>">
                Read more
              </a>
            </div>
          </div>
        </div>

      <?php endwhile; ?>
      </div>

      <?php get_template_part( 'partials/pagination' ); ?>

    </div>

  </section>

  <?php
  else :
    get_template_part( 'partials/no-content-found' );
  endif; ?>

<?php get_footer(); ?>
