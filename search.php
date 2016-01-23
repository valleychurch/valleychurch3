<?php get_header(); ?>

  <?php //get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xxs-12 c-post-content u-center-block">

        <h1>Search results for <?php the_search_query(); ?></h1>

      </div>

    </article>

  </section>

  <?php if ( have_posts() ) : ?>

  <section class="o-container c-section c-section--grey">

    <div class="o-row">

    <?php while ( have_posts() ) : the_post(); ?>

      <div class="o-col-xxs-12">
        <div class="o-row u-margin--double">
          <div class="o-col-xxs-12 o-col-sm-5 o-col-md-4 o-col-lg-3 u-margin">
          <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail();
          } ?>
          </div>
          <div class="o-col-xxs-12 o-col-sm-7 o-col-md-8 o-col-lg-9">
            <h2 class="u-margin--half"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h2>
            <p class="u-text-muted"><em><?php echo str_replace( 'http://', '', get_permalink() ); ?></em></p>
            <?php the_excerpt(); ?>
            <a class="o-btn" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
              Read more
            </a>
          </div>
        </div>
      </div>

    <?php endwhile; ?>

    </div>

    <?php get_template_part( 'partials/pagination' ); ?>

  </section>

  <?php else : ?>
  <?php get_template_part( 'partials/no-content-found' ); ?>
  <?php endif; ?>

<?php get_footer(); ?>