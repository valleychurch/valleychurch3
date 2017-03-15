<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}

$img_id = get_query_var( 'image_id', get_post_thumbnail_id( $post->ID ) );
if ( $img_id === "" ) {
  $img_id = 11332;
}

$img = wp_get_attachment_image_src( $img_id, 'slide' );
$img_medium = wp_get_attachment_image_src( $img_id, 'slide-medium' );
$img_small = wp_get_attachment_image_src( $img_id, 'slide-small' );

$background_position;
if ( get_field( 'featured_image_position' ) ) {
  $background_position = "u-object-" . strtolower( get_field( 'featured_image_position' ) );
}
?>
<img
  src="<?= $img_medium[0]; ?>"
  srcset="<?= $img_small[0]; ?> 640w,
          <?= $img_medium[0]; ?> 1280w,
          <?= $img[0]; ?> 2000w"
  width="<?= $img[1] ?>"
  height="<?= $img[2] ?>"
  alt="<?php the_title(); ?>"
  class="<?= ( get_query_var( 'class' ) == true ) ? get_query_var( 'class' ) : "c-section__img"; ?> <?= $background_position ?>">
