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

          <div class="o-col-md-4">

            <div class="o-flag u-margin">
              <div class="o-flag__fix">
                <?php get_template_part( 'partials/avatar' ); ?>
              </div>
              <div class="o-flag__flex">
                <p class="lead u-margin--none">
                  <?php the_author(); ?>
                </p>
                <p class="small u-text-muted u-margin--none">
                  <strong>
                    <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
                  </strong>
                </p>
              </div>
            </div>

            <?php
              $twitter = get_the_author_meta( 'twitter', $post->post_author );
              $facebook = get_the_author_meta( 'facebook', $post->post_author );
              $instagram = get_the_author_meta( 'instagram', $post->post_author );
              if ($twitter || $facebook || $instagram) {
            ?>
            <p class="author-social">
              <?php if ($twitter) { ?>
              <a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank">
                <i class="fa fa-lg fa-twitter-square"></i>
              </a>
              <?php }
              if ($facebook) { ?>
              <a href="http://facebook.com/<?php echo $facebook; ?>" target="_blank">
                <i class="fa fa-lg fa-facebook-square"></i>
              </a>
              <?php }
              if ($instagram) { ?>
              <a href="http://instagram.com/<?php echo $instagram; ?>" target="_blank">
                <i class="fa fa-lg fa-instagram"></i>
              </a>
              <?php } ?>
            </p>
            <?php } ?>

          </div>

          <div class="o-col-md-8 o-col-lg-7">

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