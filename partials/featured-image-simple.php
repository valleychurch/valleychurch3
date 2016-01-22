<?php
if ( get_query_var( 'page_id' ) ) {
  $post->ID = get_query_var( 'page_id' );
}
if ( has_post_thumbnail() ) {
  $img_id = get_post_thumbnail_id( $post->ID );
  $img_banner = wp_get_attachment_image_src( $img_id, 'full' );
  $img_banner_large = wp_get_attachment_image_src( $img_id, 'large' );
  $img_banner_medium = wp_get_attachment_image_src( $img_id, 'medium' );
  $img_banner_small = wp_get_attachment_image_src( $img_id, 'small' );
  ?>
<figure class="c-featured <?php ( get_query_var( 'margin' ) == true ) ? print "u-margin" : ""; ?>">
  <picture>
    <?php if ( $img_banner ) { ?>
    <source media="(min-width: 70rem)" srcset="<?php echo $img_banner[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner_large ) { ?>
    <source media="(min-width: 50rem)" srcset="<?php echo $img_banner_large[0]; ?>">
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
</figure>
<?php } ?>