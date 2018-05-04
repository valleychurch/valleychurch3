<?php if ( $_COOKIE["valleyHideCookieBar"] !== "1" ) { ?>
<div class="c-notification c-notification--fixed u-background-grey--1 is-notification-active" data-cookie-popup="true" aria-expanded="true">
  <div class="o-container o-container--full">
    <div class="o-flag o-flag--rev">
      <div class="o-flag__flex u-text-left">
        <p class="u-text-left"><strong>This site uses cookies.</strong> Some of these cookies are essential, while others help us to improve your experience by providing insights into how the site is being used.<br class="u-hide u-show@md"/>Please view our <a href="/cookies">Cookie Policy</a> to find out more.</p>
      </div>
      <div class="o-flag__fix">
        <button aria-label="Dismiss notification" class="u-margin-none js-cookies-dismiss o-btn o-btn--ghost o-btn--ghost--white">
          Got it
        </button>
      </div>
    </div>
  </div>
</div>
<?php } ?>