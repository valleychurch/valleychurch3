<?php get_header(); ?>

  <?php
  $message_id = $post->ID;
  $messages_page_id = get_page_by_path( '/messages' );
  set_query_var( 'page_id', $messages_page_id->ID );
  get_template_part( 'partials/featured-image' );
  ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xs-12 o-col-md-10 c-post-content u-center-block">

        <div class="o-row">

          <div class="o-col-xs-12 o-col-md-4">

            <?php
            set_query_var( 'page_id', $message_id );
            set_query_var( 'margin', true );
            get_template_part( 'partials/featured-image-simple' );
            ?>

          </div>

          <div class="o-col-xs-12 o-col-md-8">

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

        </div>

      </div>

    </article>

  </section>

<?php get_footer(); ?>