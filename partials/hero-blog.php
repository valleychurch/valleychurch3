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

$background_position;
if ( get_field( 'featured_image_position' ) ) {
  $background_position = "u-object-" . strtolower( get_field( 'featured_image_position' ) );
}
?>
<?php if ( get_query_var( 'figure' ) === true ) { ?>
<figure class="c-featured">
<?php } ?>
<img
  src="<?= $img_medium[0]; ?>"
  alt="<?= the_title(); ?>"
  width="<?= $img_medium[1] ?>"
  height="<?= $img_medium[2] ?>"
  class="<?= get_query_var( 'class', 'c-section__img' ); ?>
  <?= ( get_query_var( 'margin' ) === true ) ? "u-margin" : ""; ?> <?= $background_position ?>">
<?php if ( get_query_var( 'figure' ) === true ) { ?>
</figure>
<?php } ?>
