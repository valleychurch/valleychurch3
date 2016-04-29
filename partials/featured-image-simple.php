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
  $img = wp_get_attachment_image_src( $img_id, 'full' );
  $img_large = wp_get_attachment_image_src( $img_id, 'large' );
  $img_medium = wp_get_attachment_image_src( $img_id, 'medium' );
  $img_small = wp_get_attachment_image_src( $img_id, 'small' );
  ?>
<figure class="c-featured <?= ( get_query_var( 'class' ) == true ) ? get_query_var( 'class') : ""; ?> <?= ( get_query_var( 'margin' ) == true ) ? "u-margin" : ""; ?> ">
  <picture>
    <?php if ( $img || $img_large || $img_medium || $img_small ) { ?>
    <!--[if IE 9]><video style="display: none;"><![endif]-->
    <?php }
    if ( $img ) { ?>
    <source media="(min-width: 70rem)" srcset="<?= $img[0]; ?>">
    <?php }
    if ( $img_large ) { ?>
    <source media="(min-width: 50rem)" srcset="<?= $img_large[0]; ?>">
    <?php }
    if ( $img_medium ) { ?>
    <source media="(min-width: 40rem)" srcset="<?= $img_medium[0]; ?>">
    <?php }
    if ( $img_small ) { ?>
    <source srcset="<?= $img_small[0]; ?>">
    <?php }
    if ( $img || $img_large || $img_medium || $img_small ) { ?>
    <!--[if IE 9]></video><![endif]-->
    <?php }
    if ( $img ) { ?>
    <img srcset="<?= $img[0]; ?>" alt="<?php the_title(); ?>" width="<?= $img[1]; ?>" height="<?= $img[2]; ?>">
    <?php } ?>
  </picture>
</figure>
<?php } ?>
