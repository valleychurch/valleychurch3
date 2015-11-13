<?php
  $size = 128;
  $alt = get_the_author_meta( 'display_name' );
  $initials = substr(get_the_author_meta('first_name'),0,1) . substr(get_the_author_meta('last_name'),0,1);
  if ( has_gravatar( get_the_author_meta( 'user_email' ) ) ) { ?>
<figure class="c-avatar c-avatar--lg">
  <?php echo get_avatar( get_the_author_meta( 'ID' ), $size, '', $alt ); ?>
</figure>
<?php } else { ?>
<figure class="c-avatar c-avatar--lg c-avatar--no-img" data-initials="<?php echo $initials; ?>">
</figure>
<?php } ?>