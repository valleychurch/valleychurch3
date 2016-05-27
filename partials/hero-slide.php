<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}

$img_id = get_query_var( 'image_id', get_post_thumbnail_id( $post->ID ) );
if ( $img_id === "" ) {
  $img_id = 11332;
}

$img_slide = wp_get_attachment_image_src( $img_id, 'slide' );
$img_slide_medium = wp_get_attachment_image_src( $img_id, 'slide-medium' );
$img_slide_small = wp_get_attachment_image_src( $img_id, 'slide-small' );
?>
<img srcset="<?= $img_slide_small[0]; ?> 640w, <?= $img_slide_medium[0]; ?> 1280w, <?= $img_slide[0]; ?> 2000w" alt="<?php the_title(); ?>" class="<?= ( get_query_var( 'class' ) == true ) ? get_query_var( 'class' ) : "c-section__img"; ?>">
