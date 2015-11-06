<?php get_header(); ?>

      <?php if ( has_post_thumbnail() ) { ?>
      <figure class="c-featured">
        <?php
        the_post_thumbnail();
        if ( isset( get_post( get_post_thumbnail_id())->post_excerpt ) ) { ?>
        <figcaption class="o-container c-featured__caption">
          <?php echo get_post( get_post_thumbnail_id())->post_excerpt; ?>
        </figcaption>
        <?php } ?>
      </figure>
      <?php } ?>

      <article <?php post_class( 'o-container' ); ?> role="article">

        <div class="o-row">

          <div class="o-col-xs-4">
          </div>

          <div class="o-col-xs-6">

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

          </div>

        </div>

      </article>


      <section class="comments o-container">

        <div class="o-row">

          <div class="o-col-xs-6 o-col-xs--offset-4">

            <hr/>

            <?php comments_template(); ?>

          </div>

        </div>

      </section>

<?php get_footer(); ?>