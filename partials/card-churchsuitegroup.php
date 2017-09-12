<?php
  $frequency = ucfirst( get_field( 'frequency' ) );

  $startDate = strtotime( get_field( 'date_start' ) );
  $endDate = strtotime( get_field( 'date_end' ) );

  $day = get_field( 'day' );
  $dayMap = array('', 'Mondays', 'Tuesdays', 'Wednesdays', 'Thursdays', 'Fridays', 'Saturdays', 'Sundays', 'various days');
  $time = strtotime( get_field( 'time' ) );

  $url = get_field( 'signup_url' );
?>

<article <?= post_class() ?>>
  <a class="o-card o-card--shadow" href="<?= $url ?>" target="_blank" title="<?= get_the_title(); ?>">

    <div class="o-card__body">
      <h3 class="o-card__title u-margin-half">
        <?php the_title(); ?>
      </h3>

      <h4 class="o-card__subtitle u-margin-quarter u-text-black">
        <?= date("jS F", $startDate) ?> &ndash; <?= date("jS F", $endDate) ?>
      </h4>

      <p class="h5 o-card__subtitle u-margin-none u-text-black">
        <?= $frequency ?> on <?= $dayMap[$day] ?> at <?= date("g:ia", $time) ?>
      </p>
    </div>
  </a>
</article>
