<article <?= post_class("o-card o-card--shadow") ?>>
  <a href="<?= get_permalink(); ?>">
  <?php set_query_var( 'class', 'o-card__img' ); ?>
  <?php get_template_part( 'partials/hero-blog' ); ?>
  </a>
  <div class="o-card__body">
    <p class="small u-text-muted u-margin-quarter">
      <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
    </p>
    <h3 class="o-card__title u-margin-top-none">
      <a href="<?= get_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>
    <div class="o-flag <?= ( !is_home() ) ? "u-margin-double" : ""; ?>">
      <div class="o-flag__fix">
        <?php
          set_query_var( 'size', 'sm' );
          get_template_part( 'partials/avatar' );
        ?>
      </div>
      <div class="o-flag__flex">
        <p class="u-margin-none small u-line-height--small">
          <?php the_author(); ?>
        </p>
      </div>
    </div>
    <?php if ( !is_home() ) { ?>
    <div class="o-card__text">
      <?php if ( get_the_excerpt() !== "" ) {
        the_excerpt();
      } else {
        the_content('Read more');
      } ?>
      <p class="u-margin-none">
        <?php comments_popup_link(); ?>
      </p>
    </div>
    <?php } ?>
  </div>
</article>
