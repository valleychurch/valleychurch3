<?php
get_header();
$front_page_id = get_option( 'page_for_posts' );
$paged = get_query_var( 'paged', 1 );
?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row u-text-center">

        <div class="o-col-12@xxs">
          <h1 class="kilo u-margin-half">Recent Blogs</h1>
        </div>

        <div class="o-col-12@xxs o-col-8@sm o-col-7@md u-center-block">
          <p class="lead u-margin-none">
            We're all about empowering you to be all God's called you to be, so check back weekly for inspirational thoughts, blogs and messages from our Pastors and team.
          </p>
        </div>

      </div>

    </article>

  </section>

  <section class="c-section u-background-grey--11">

    <div class="o-container">

      <div class="o-row">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <div class="o-col-12@xxs o-col-4@sm">
            <?php get_template_part( 'partials/card', 'blog' ); ?>
          </div>

        <?php
        endwhile;
        get_template_part( 'partials/pagination' );
        else :
          get_template_part( 'no-content-found' );
        endif;
        ?>

      </div>

    </div>

  </section>

<?php get_footer(); ?>
