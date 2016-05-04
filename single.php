<?php get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <div class="o-flag u-margin--double">
          <div class="o-flag__fix">
            <?php get_template_part( 'partials/avatar' ); ?>
          </div>
          <div class="o-flag__flex">
            <p class="u-margin--none">
              <?php the_author(); ?>
            </p>
            <p class="small u-text-muted u-margin--none">
              <strong>
                <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
              </strong>
            </p>
          </div>
        </div>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <section class="o-container c-section">

    <div class="o-row">

      <div class="c-post-content c-post-content--fixed u-center-block">

        <hr/>

        <?php comments_template(); ?>

      </div>

    </div>

  </section>

<?php get_footer(); ?>
