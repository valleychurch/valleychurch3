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
<figure class="c-featured <?php ( get_query_var( 'class' ) == true ) ? print get_query_var( 'class') : ""; ?> <?php ( get_query_var( 'margin' ) == true ) ? print "u-margin" : ""; ?> ">
  <picture>
    <?php if ( $img ) { ?>
    <source media="(min-width: 70rem)" srcset="<?php echo $img[0]; ?>">
    <?php } ?>
    <?php if ( $img_large ) { ?>
    <source media="(min-width: 50rem)" srcset="<?php echo $img_large[0]; ?>">
    <?php } ?>
    <?php if ( $img_medium ) { ?>
    <source media="(min-width: 40rem)" srcset="<?php echo $img_medium[0]; ?>">
    <?php } ?>
    <?php if ( $img_small ) { ?>
    <source srcset="<?php echo $img_small[0]; ?>">
    <?php } ?>
    <?php if ( $img ) { ?>
    <img srcset="<?php echo $img[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>">
    <?php } ?>
  </picture>
</figure>
<?php } ?>