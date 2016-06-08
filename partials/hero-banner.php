<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}

$img_id = get_query_var( 'image_id', get_post_thumbnail_id( $post->ID ) );
if ( $img_id === "" ) {
  $img_id = 11332;
}

$img_banner = wp_get_attachment_image_src( $img_id, 'banner' );
$img_banner_medium = wp_get_attachment_image_src( $img_id, 'banner-medium' );
$img_banner_small = wp_get_attachment_image_src( $img_id, 'banner-small' );
?>
<?php if ( get_query_var( 'figure' ) === true ) { ?>
<figure class="c-featured">
<?php } ?>
  <img srcset="<?= $img_banner_small[0]; ?> 640w, <?= $img_banner_medium[0]; ?> 1280w, <?= $img_banner[0]; ?> 2000w" alt="<?php the_title(); ?>" class="<?= get_query_var( 'class', 'c-section__img' ); ?>">
<?php if ( get_query_var( 'figure' ) === true ) { ?>
</figure>
<?php } ?>
