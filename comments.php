<?php
// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

if ( have_comments() ) : ?>

<?php endif; ?>

<?php if ( ! comments_open() ) : ?>
  <p class="lead">Comments are closed for this post.</p>
<?php endif; ?>

<?php comment_form(); ?>