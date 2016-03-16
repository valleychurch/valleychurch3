<?php
$size = 128;
$id = get_the_author_meta( 'ID' );
$email = get_the_author_meta( 'user_email' );
$alt = get_the_author_meta( 'display_name' );
$fallback = get_template_directory_uri() . '/assets/images/dist/touchicon-nooutline.png';
$initials = substr(get_the_author_meta('first_name'),0,1) . substr(get_the_author_meta('last_name'),0,1);

if ( get_avatar( $id ) ) { ?>
<figure class="c-avatar c-avatar--md">
  <?= get_avatar( $id, $size, $fallback, $alt ); ?>
</figure>
<?php } else { ?>
<figure class="c-avatar c-avatar--md c-avatar--no-img" data-initials="<?= $initials; ?>">
</figure>
<?php } ?>
