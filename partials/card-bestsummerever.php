<article <?= post_class() ?> itemscope itemtype="http://schema.org/Event">
  <div class="o-card u-text-center" title="<?= get_the_title(); ?>">
    <div class="o-card__body">
      <h2 class="h3 o-card__title" itemprop="name">
        <?php the_title(); ?>
      </h2>
      <?php if ( get_field( 'date_start' ) ) { ?>
      <h3 class="h4 o-card__subtitle u-margin-none u-text-black" <?= ( get_field( 'date_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'date_start' ) ) . '"' : "" ); ?>>
        <?= date('jS F', strtotime( get_field( 'date_start' ) ) ); ?>
      </h3>
      <?php } ?>
    </div>
  </div>
</article>
