<?php get_header(); ?>

<?php if (have_posts()) : ?>

  <div class="o-container">
    <div class="o-row">

  <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class( 'o-col-xs-12 u-margin u-margin--md--double' ); ?> role="article">
      <div class="o-row">
        <figure class="o-col-xs-12 o-col-md-3 o-col-lg-4">
          <?php the_post_thumbnail(); ?>
        </figure>
        <div class="o-col-xs-12 o-col-md-9 o-col-lg-8">
          <h2 class="h1">
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h2>
          <?php the_content('Read more'); ?>
        </div>
      </div>
    </article>

  <?php endwhile; else: ?>

    </div>
  </div>

  <h1>No posts!</h1> <!-- TODO -->

<?php endif; ?>

<?php get_footer(); ?>