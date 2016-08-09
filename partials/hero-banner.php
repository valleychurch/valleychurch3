<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}

$img_id = get_query_var( 'image_id', get_post_thumbnail_id( $post->ID ) );
if ( $img_id === "" ) {
  $img_id = 11332;
}

$banner_xxl = wp_get_attachment_image_src( $img_id, 'banner-xxl' );
$banner_xl = wp_get_attachment_image_src( $img_id, 'banner-xl' );
$banner_lg = wp_get_attachment_image_src( $img_id, 'banner-lg' );
$banner_md = wp_get_attachment_image_src( $img_id, 'banner-md' );
$banner_sm = wp_get_attachment_image_src( $img_id, 'banner-sm' );
$banner_xs = wp_get_attachment_image_src( $img_id, 'banner-xs' );
?>
<?php if ( get_query_var( 'figure' ) === true ) { ?>
<figure class="c-featured">
<?php } ?>
<img
  src="<?= $banner_lg[0]; ?>"
  srcset="<?= $banner_xs[0]; ?> 320w,
          <?= $banner_sm[0]; ?> 640w,
          <?= $banner_md[0]; ?> 960w,
          <?= $banner_lg[0]; ?> 1280w,
          <?= $banner_xl[0]; ?> 1680w,
          <?= $banner_xxl[0]; ?> 2000w"
  alt="<?php the_title(); ?>"
  class="<?= get_query_var( 'class', 'c-section__img' ); ?>">
<?php if ( get_query_var( 'figure' ) === true ) { ?>
</figure>
<?php } ?>
