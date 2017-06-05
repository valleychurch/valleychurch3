<?php
  $has_datetime_start = get_field( 'datetime_start' );
  $is_all_day = get_field( 'all_day_event' ) == 1;

  $datetime_start = strtotime( get_field( 'datetime_start' ) );
  $datetime_end = strtotime( get_field( 'datetime_end ') );

  $is_multi_day = false;
  $datetime_diff = floor( ( $datetime_end - $datetime_start ) / 86400 );

  if ( $datetime_diff > 0 ) {
    $is_multi_day = true;
  }
?>

<article <?= post_class() ?> itemscope itemtype="http://schema.org/Event">
  <a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>" itemprop="url">
    <?php
      if ( has_post_thumbnail() ) {
        set_query_var( 'class', 'o-card__img' );
        get_template_part( 'partials/hero', 'slide' );
      }
    ?>
    <div class="o-card__body u-text-center">
      <h2 class="h3 o-card__title <?= $has_datetime_start ? 'u-margin-half' : 'u-margin-none' ?>" itemprop="name">
        <?php the_title(); ?>
      </h2>
      <?php if ( $has_datetime_start ) { ?>
      <h3 class="h4 o-card__subtitle u-margin-none u-text-black" <?= ( get_field( 'datetimestamp_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'datetimestamp_start' ) ) . '"' : "" ); ?>>
        <?php
        if ( $is_all_day && $is_multi_day ) {
          echo date('jS F', $datetime_start ) . " &ndash; " . date('jS F', $datetime_end );
        }
        else if ( $is_all_day ) {
          echo date('jS F', $datetime_start );
        }
        else {
          echo date('jS F, g:ia', $datetime_start );
        } ?>
      </h3>
      <?php } ?>
      <?php if ( get_field( 'location' ) ) { ?>
      <span class="u-hidden" itemprop="location" itemscope itemtype="http://schema.org/Place">
        <span itemprop="name"><?= the_field( 'location' ) ?></span>
        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
          <?php if ( get_field( 'location_address' ) ) { ?>
          <span itemprop="postalCode"><?= the_field( 'location_address' ) ?></span>
          <?php } ?>
        </span>
        <?php if ( get_field( 'location_latitude' ) && ( get_field( 'location_longitude' ) ) ) { ?>
        <span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
          <meta itemprop="latitude" content="<?= the_field( 'location_latitude' ) ?>" />
          <meta itemprop="longitude" content="<?= the_field( 'location_longitude' ) ?>" />
        </span>
        <?php } ?>
      </span>
      <?php } ?>
    </div>
  </a>
</article>
