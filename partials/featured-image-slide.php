<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}
if ( get_query_var( 'image_id' ) ) {
  $img_id = get_query_var( 'image_id' );
}
else {
  $img_id = get_post_thumbnail_id( $post->ID );
}
if ( ( ( is_single() || is_page() ) && has_post_thumbnail() ) || $img_id ) {
  $img_slide = wp_get_attachment_image_src( $img_id, 'slide' );
  $img_slide_medium = wp_get_attachment_image_src( $img_id, 'slide-medium' );
  $img_slide_small = wp_get_attachment_image_src( $img_id, 'slide-small' );
  ?>
<figure class="c-featured <?php ( get_query_var( 'class' ) == true ) ? print get_query_var( 'class') : ""; ?> <?php ( get_query_var( 'margin' ) == true ) ? print "u-margin" : ""; ?> ">
  <picture>
    <?php if ( $img_slide_small ) { ?>
    <source media="(min-width: 60rem)" srcset="<?= $img_slide_small[0]; ?>">
    <?php }
    if ( $img_slide_medium ) { ?>
    <source media="(min-width: 40rem)" srcset="<?= $img_slide_medium[0]; ?>">
    <?php }
    if ( $img_slide_small ) { ?>
    <source srcset="<?= $img_slide_small[0]; ?>">
    <?php }
    if ( $img_slide ) { ?>
    <img srcset="<?= $img_slide[0]; ?>" alt="<?php the_title(); ?>" width="<?= $img_slide[1]; ?>" height="<?= $img_slide[2]; ?>">
    <?php } ?>
  </picture>
</figure>
<?php } ?>
