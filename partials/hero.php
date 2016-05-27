<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}

$img_id = get_query_var( 'image_id', get_post_thumbnail_id( $post->ID ) );
if ( $img_id === "" ) {
  $img_id = 11332;
}

$img = wp_get_attachment_image_src( $img_id, 'full' );
$img_large = wp_get_attachment_image_src( $img_id, 'large' );
$img_medium = wp_get_attachment_image_src( $img_id, 'medium' );
?>
<img srcset="<?= $img_medium[0]; ?> 640w, <?= $img_large[0]; ?> 1280w, <?= $img[0]; ?> 2000w" alt="<?php the_title(); ?>" class="<?= get_query_var( 'class', 'c-section__img' ); ?>">
