<article <?= post_class() ?> itemscope itemtype="http://schema.org/Event">
  <a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>" itemprop="url">
    <?php
      if ( has_post_thumbnail() ) {
        set_query_var( 'class', 'o-card__img' );
        get_template_part( 'partials/hero', 'slide' );
      }
    ?>
    <div class="o-card__body u-text-center">
      <h2 class="h3 o-card__title <?= ( get_field( 'datetime_start' ) ) ? 'u-margin-half' : 'u-margin-none' ?>" itemprop="name">
        <?php the_title(); ?>
      </h2>
      <?php if ( get_field( 'datetime_start' ) ) { ?>
      <h3 class="h4 o-card__subtitle u-margin-none u-text-black" <?= ( get_field( 'datetimestamp_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'datetimestamp_start' ) ) . '"' : "" ); ?>>
        <?php if ( get_field( 'all_day_event' ) == 1 ) {
          echo date('jS F', strtotime( get_field( 'datetime_start' ) ) );
        }
        else {
          echo date('jS F, g:ia', strtotime( get_field( 'datetime_start' ) ) );
        } ?>
      </h3>
        <?php if ( get_field( 'datetime_end' ) ) { ?>
        <span class="u-hidden" itemprop="endDate" content="<?= date( 'c', get_field( 'datetime_end' ) ?>">
          <?= date('jS F, g:ia', strtotime( get_field( 'datetime_start' ) ) ) ?>
        </span>
        <?php } ?>
      <?php } ?>
      <?php if ( get_field( 'location' ) ) { ?>
      <div class="u-hidden" itemprop="location" itemscope itemtype="http://schema.org/Place">
        <span itemprop="name"><?= the_field( 'location' ) ?></span>
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
          <span itemprop="postalCode"><?= the_field( 'location_address' ) ?></span>
        </div>
        <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
          <meta itemprop="latitude" content="<?= the_field( 'location_latitude' ) ?>">
          <meta itemprop="longitude" content="<?= the_field( 'location_longitude' ) ?>">
        </div>
      </div>
      <?php } ?>
    </div>
  </a>
</article>
