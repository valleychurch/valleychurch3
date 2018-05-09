<?php
$datetimestart = strtotime( get_field('date_start') );
$datetimeend = strtotime( get_field('date_end') );

$location = get_field( 'event_location' );
$link = get_field( 'event_link' );
?>

<article <?= post_class() ?> itemscope itemtype="http://schema.org/Event">
  <a class="o-card o-card--bestsummerever u-text-center" title="<?= get_the_title(); ?>" <?php if ( $link ) { echo "href='" . $link  . "' itemprop='url'"; } ?>>
    <?php
    if (has_post_thumbnail()) {
      set_query_var('class', 'o-card__img');
      get_template_part('partials/hero', 'slide');
    }
    ?>
    <div class="o-card__body">
      <h2 class="h3 o-card__title" itemprop="name">
        <?php the_title(); ?>
      </h2>
      <h3 class="h4 o-card__subtitle u-margin-none u-text-black" <?= ( get_field( 'date_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'date_start' ) ) . '"' : "" ); ?>>
        <?php if ( $location ) {
          echo $location . '<br/>';
        }
        if ( $datetimestart != $datetimeend ) {
          echo date( 'jS', $datetimestart ) . "&ndash;" . date( 'jS M', $datetimeend );
        }
        else {
          echo date( 'jS M', $datetimestart );
        }
        ?>
      </h3>
    </div>
  </a>
</article>
