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
  $img_banner = wp_get_attachment_image_src( $img_id, 'banner' );
  $img_banner_medium = wp_get_attachment_image_src( $img_id, 'banner-medium' );
  $img_banner_small = wp_get_attachment_image_src( $img_id, 'banner-small' );
  ?>
<figure class="c-featured <?php ( get_query_var( 'class' ) == true ) ? print get_query_var( 'class') : ""; ?> <?php ( get_query_var( 'margin' ) == true ) ? print "u-margin" : ""; ?> ">
  <picture>
    <?php if ( $img_banner ) { ?>
    <source media="(min-width: 70rem)" srcset="<?php echo $img_banner[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner_medium ) { ?>
    <source media="(min-width: 40rem)" srcset="<?php echo $img_banner_medium[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner_small ) { ?>
    <source srcset="<?php echo $img_banner_small[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner ) { ?>
    <img srcset="<?php echo $img_banner[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $img_banner[1]; ?>" height="<?php echo $img_banner[2]; ?>">
    <?php } ?>
  </picture>

  <!-- TODO: Add featured image captions for blog posts -->
  <?php //if ( get_post( $attachment_id )->post_excerpt !== "" ) { ?>
  <!-- <figcaption class="o-container c-featured__caption">
    <?php //echo get_post( $attachment_id )->post_excerpt; ?>
  </figcaption> -->
  <?php //} ?>

</figure>
<?php } ?>