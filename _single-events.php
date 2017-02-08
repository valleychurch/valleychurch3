<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }

  $h1_class;

  if ( get_field( 'event_date' ) ) {
    $h1_class .= "u-margin-quarter";
  }

  if ( get_field( 'hide_h1' ) ) {
    $h1_class .= "u-hidden ";
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?> itemscope itemtype="http://schema.org/Event">

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <h1 class="<?= $h1_class ?>" itemprop="name">
          <?php if ( get_field( 'custom_h1' ) ) {
            get_field( 'custom_h1' );
          } else {
            the_title();
          } ?>
          </h1>

          <?php if ( get_field( 'event_date' ) ) { ?>
          <h2 class="h3" <?= ( get_field( 'event_start_datetime' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'event_start_datetime' ) ) . '"' : "" ); ?>>
            <?php if ( get_field( 'event_time' ) ) {
              echo get_field( 'event_date' ) . ', ' . get_field( 'event_time' );
            } else {
              the_field( 'event_date' );
            } ?>
          </h2>
          <?php } ?>

          <?php the_content(); ?>

          <?php get_template_part('partials/sharer'); ?>

        </div>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
