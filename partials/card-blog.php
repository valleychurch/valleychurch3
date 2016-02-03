<div class="o-card o-card--shadow">
  <?php get_template_part( 'partials/featured-image' ); ?>
  <div class="o-card__body">
    <h3 class="h1 o-card__title">
      <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>
    <div class="o-card__text">
      <div class="o-flag u-margin--double">
        <div class="o-flag__fix">
          <?php get_template_part( 'partials/avatar' ); ?>
        </div>
        <div class="o-flag__flex">
          <p class="u-margin--none">
            <?php the_author(); ?>
          </p>
          <p class="small u-text-muted u-margin--none">
            <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
          </p>
        </div>
      </div>
      <?php the_content('Read more'); ?>
      <p class="u-margin--none">
        <?php comments_popup_link(); ?>
      </p>
    </div>
  </div>
</div>