<?php get_header(); ?>

<?php if (have_posts()) : ?>

  <div class="o-container">
    <div class="o-row">

  <?php while (have_posts()) : the_post(); ?>

    <div class="o-col-xs-12 o-col-md-4">
      <article <?php post_class( 'u-margin u-margin--md--double' ); ?> role="article">
        <figure>
          <?php the_post_thumbnail(); ?>
        </figure>
        <h2>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
        <?php // the_content('Read more'); ?>
      </article>
    </div>

  <?php endwhile; else: ?>

    </div>
  </div>

  <h1>No posts!</h1> <!-- TODO -->

<?php endif; ?>

<?php get_footer(); ?>