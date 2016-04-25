<?php get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1 <?php ( get_field( 'hide_h1' ) == 1 ) ? print 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <?php
  $cards = get_field( 'cards' );
  $card_class = get_field( 'card_class' );
  if ( have_rows( 'cards' ) ) { ?>
  <section class="o-container c-section c-section--grey">
    <div class="o-row">
    <?php
    while ( have_rows( 'cards' ) ) {
      the_row(); ?>

      <div class="<?php ( get_field( 'card_class' ) ) ? print get_field( 'card_class' ) : print "o-col-xxs-12 o-col-md-6"; ?>">
        <div class="o-card u-text-center">
          <?php if ( get_sub_field( 'image' ) ) {
            set_query_var( 'image_id', get_sub_field( 'image' )["id"] );
            set_query_var( 'class', 'o-card__img' );
            get_template_part( 'partials/featured-image', 'slide' );
          } ?>

          <?php if ( get_sub_field( 'title' ) || get_sub_field( 'content' ) ) { ?>
          <div class="o-card__body">

            <?php if ( get_sub_field( 'title' ) ) { ?>
            <h2 class="h3 o-card__title"><?= get_sub_field( 'title' ); ?></h2>
            <?php } ?>

            <?php if ( get_sub_field( 'content' ) ) { ?>
            <p class="o-card__text">
              <?= get_sub_field( 'content' ); ?>
            </p>
            <?php } ?>

            <?php if ( get_sub_field( 'show_button' ) == 1 ) { ?>
            <a class="o-btn" href="<?php the_sub_field( 'button_link' ); ?>">
              <?php if ( get_sub_field( 'button_text' ) ) {
                echo get_sub_field( 'button_text' );
              } ?>
            </a>
            <?php } ?>

          </div>
          <?php } ?>

        </div>
      </div>

    <?php } ?>
    </div>
  </section>
  <?php } ?>

<?php get_footer(); ?>
