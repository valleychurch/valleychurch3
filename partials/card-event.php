<article <?= post_class() ?> itemscope itemtype="http://schema.org/Event">
  <a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>" itemprop="url">
    <?php
      if ( has_post_thumbnail() ) {
        set_query_var( 'class', 'o-card__img' );
        get_template_part( 'partials/hero', 'slide' );
      }
    ?>
    <div class="o-card__body u-text-center">
      <h2 class="h3 o-card__title <?= ( get_field( 'event_date' ) ) ? 'u-margin-half' : 'u-margin-none' ?>" itemprop="name">
        <?php the_title(); ?>
      </h2>
      <?php if ( get_field( 'event_date' ) ) { ?>
      <h3 class="h4 o-card__subtitle u-margin-none u-text-black" <?= ( get_field( 'event_start_datetime' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'event_start_datetime' ) ) . '"' : "" ); ?>>
        <?php if ( get_field( 'event_time' ) ) {
          echo get_field( 'event_date' ) . ', ' . get_field( 'event_time' );
        } else {
          the_field( 'event_date' );
        } ?>
      </h3>
      <?php } ?>
    </div>
  </a>
</article>
