<?php
if ( has_post_thumbnail() ) {
  $img_id = get_post_thumbnail_id( $post->ID );
  $img_banner = wp_get_attachment_image_src( $img_id, 'banner' );
  $img_banner_small = wp_get_attachment_image_src( $img_id, 'banner-small' );
  $img_banner_xsmall = wp_get_attachment_image_src( $img_id, 'banner-xsmall' );
  ?>
<figure class="c-featured">
  <picture>
    <?php if ( $img_banner ) { ?>
    <source media="(min-width: 70rem)" srcset="<?php echo $img_banner[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner_small ) { ?>
    <source media="(min-width: 50rem)" srcset="<?php echo $img_banner_small[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner_xsmall ) { ?>
    <source srcset="<?php echo $img_banner_xsmall[0]; ?>">
    <?php } ?>
    <?php if ( $img_banner ) { ?>
    <img src="<?php echo $img_banner[0]; ?>" alt="<?php the_title(); ?>">
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