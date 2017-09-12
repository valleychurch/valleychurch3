<?php
  $frequency = ucfirst( get_field( 'frequency' ) );
  $day = get_field( 'day' );
  $dayMap = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'various days');
  $time = strtotime( get_field( 'time' ) );
?>

<article <?= post_class() ?>>
  <a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>">

    <div class="o-card__body u-text-center">
      <h2 class="h3 o-card__title u-margin-half">
        <?php the_title(); ?>
      </h2>

      <h3 class="h4 o-card__subtitle u-margin-none u-text-black">
        <?= $frequency ?> on <?= dayMap[$day] ?> at <?= date("h:i:sa", $time) ?>
      </h3>
    </div>
  </a>
</article>
