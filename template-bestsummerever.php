<?php
/*
  Template Name: Best Summer Ever 2018
 */
get_header();
?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>
          <?php } ?>

          <?php the_content(); ?>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section">
    <div class="o-container">
      <div class="o-row o-row--center">
        <?php
        $args =
          array(
          'post_type' => 'bestsummerever',
          'post_status' => array('publish'),
          'posts_per_page' => -1,
          'orderby' => 'meta_value',
          'order' => 'ASC',
          'meta_key' => 'date_start'
        );

        $wp_query = new WP_Query($args);

        if ($wp_query->have_posts()) :
          while ($wp_query->have_posts()) :
          $wp_query->the_post(); ?>

            <div class="o-col-12@xxs o-col-6@sm o-col-3@md">
              <?php get_template_part('partials/card', 'bestsummerever'); ?>
            </div>

          <?php
          endwhile;
          else :
            get_template_part('partials/no-groups-found');
          endif;
          wp_reset_query();
          wp_reset_postdata();
          ?>
      </div>
    </div>
  </section>

  <?php
  $section = get_field('section', false, false);
  if ($section) {
    echo $section;
  }
  ?>

  <?php
  $cards = get_field('cards');
  $card_class = get_field('card_class');
  $heading = get_field('heading');
  $intro = get_field('introduction');
  ?>
  <section class="c-section">
    <div class="o-container">
      <div class="o-row">
        <div class="o-col-12@xxs o-col-8@sm o-col-7@md o-col-6@lg u-center-block u-text-center">
          <?php if ($heading) { ?>
            <h2><?= $heading ?></h2>
          <?php 
        } ?>
          <?php if ($intro) {
            echo $intro;
          } ?>
        </div>
      </div>
    <?php if (have_rows('cards')) { ?>
      <div class="o-row">
      <?php while (have_rows('cards')) {
        the_row(); ?>

        <div class="<?= (get_field('card_class')) ? $card_class : "o-col-12@xxs o-col-6@md"; ?>">
          <div class="o-card o-card--shadow">
            <?php if (get_sub_field('image')) {
              set_query_var('image_id', get_sub_field('image')["id"]);
              set_query_var('class', 'o-card__img');
              get_template_part('partials/hero', 'slide');
            } ?>

            <?php if (get_sub_field('title') || get_sub_field('content') || get_sub_field('show_button') == 1) { ?>
            <div class="o-card__body">

              <?php if (get_sub_field('title')) { ?>
              <h2 class="h3 o-card__title <?= (get_sub_field('subtitle')) ? 'u-margin-half' : '' ?>"><?= get_sub_field('title'); ?></h2>
              <?php 
            } ?>

              <?php if (get_sub_field('subtitle')) { ?>
              <h3 class="h4 o-card__subtitle u-text-black"><?= get_sub_field('subtitle'); ?></h3>
              <?php 
            } ?>

              <?php if (get_sub_field('content')) { ?>
              <p class="o-card__text"><?= get_sub_field('content'); ?></p>
              <?php 
            } ?>

            <?php
            $link = null;
            if (get_sub_field('button_external_link')) {
              $link = get_sub_field('button_external_link');
            } elseif (get_sub_field('button_link')) {
              $link = get_sub_field('button_link');
            } else $link = '';
            ?>
            <?php if (get_sub_field('show_button') == 1) { ?>
              <a class="o-btn" href="<?= $link ?>">
                <?php if (get_sub_field('button_text')) {
                  echo get_sub_field('button_text');
                } ?>
              </a>
              <?php 
            } ?>

            </div>
            <?php 
          } ?>

          </div>
        </div>

      <?php } ?>
      </div>
      <?php } ?>
    </div>
  </section>

<?php get_footer(); ?>
