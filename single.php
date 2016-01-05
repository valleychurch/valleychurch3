<?php get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="c-section o-container">

    <article <?php post_class( 'o-row c-article u-margin' ); ?> role="article">

      <div class="o-col-xs-12 c-post-content u-center-block">

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

        <?php
          $twitter = get_the_author_meta( 'twitter', $post->post_author );
          $facebook = get_the_author_meta( 'facebook', $post->post_author );
          $instagram = get_the_author_meta( 'instagram', $post->post_author );
          if ( $twitter || $facebook || $instagram ) {
        ?>
        <p class="author-social">
          <?php if ( $twitter ) { ?>
          <a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank">
            <i class="fa fa-lg fa-twitter-square"></i>
          </a>
          <?php }
          if ( $facebook ) { ?>
          <a href="http://facebook.com/<?php echo $facebook; ?>" target="_blank">
            <i class="fa fa-lg fa-facebook-square"></i>
          </a>
          <?php }
          if ( $instagram ) { ?>
          <a href="http://instagram.com/<?php echo $instagram; ?>" target="_blank">
            <i class="fa fa-lg fa-instagram"></i>
          </a>
          <?php } ?>
        </p>
        <?php } ?>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <section class="comments c-section o-container">

    <div class="o-row">

      <div class="o-col-xs-12 c-post-content u-center-block">

        <hr/>

        <?php comments_template(); ?>

      </div>

    </div>

  </section>

<?php get_footer(); ?>