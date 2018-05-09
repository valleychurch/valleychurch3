<?php
$datetimestart = strtotime( get_field('date_start') );
$datetimeend = strtotime( get_field('date_end') );

$location = get_field( 'event_location' );
?>

<article <?= post_class() ?> itemscope itemtype="http://schema.org/Event">
  <div class="o-card o-card--bestsummerever u-text-center" title="<?= get_the_title(); ?>">
    <div class="o-card__body">
      <h2 class="h3 o-card__title" itemprop="name">
        <?php the_title(); ?>
      </h2>
      <h3 class="h4 o-card__subtitle u-margin-none u-text-black" <?= ( get_field( 'date_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'date_start' ) ) . '"' : "" ); ?>>
        <?php
        if ( $datetimestart != $datetimeend ) {
          echo date( 'jS', $datetimestart ) . "&ndash;" . date( 'jS M', $datetimeend );
        }
        else {
          echo date( 'jS M', $datetimestart );
        }
        ?>
      </h3>
    </div>
  </div>
</article>