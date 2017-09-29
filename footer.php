    </main>

    <footer class="c-footer u-cf">
      <div class="o-container u-padding-top">
        <div class="o-row">

          <div class="o-col-12@xxs o-col-3@lg u-text-center@xxs u-text-left@lg u-grid-1@xxs u-grid-0@lg u-margin" itemscope itemtype="http://schema.org/LocalBusiness">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/dist/logo.svg" alt="Valley Church logo" class="u-margin c-logo">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/dist/touchicon.png" alt="Valley Church icon" class="u-hidden" itemprop="image">
            <p class="u-hidden" itemprop="name"><?= bloginfo( 'name' ); ?></p>
            <p class="small u-text-muted u-line-height--small" itemscope itemprop="address" itemtype="http://schema.org/PostalAddress">
              <span itemprop="streetAddress">
                Fourfields<br/>
                Bamber Bridge<br/>
              </span>
              <span itemprop="addressLocality">
                Preston<br/>
              </span>
              <span itemprop="addressRegion">
                Lancashire<br/>
              </span>
              <span itemprop="postalCode">
                PR5 6GS
              </span>
            </p>
            <p class="small">
              <i class="fa fa-fw fa-phone"></i> <span itemprop="telephone" content="+441772696717"><a href="tel:01772696717">01772 696717</a></span><br/>
              <i class="fa fa-fw fa-envelope"></i> <span itemprop="email"><a href="mailto:general@valleychurch.eu">general@valleychurch.eu</a></span>
            <p>
              <a href="https://twitter.com/valley_church" target="_blank" aria-label="Twitter"><i class="fa fa-lg u-text-white fa-twitter"></i></a>&nbsp;
              <a href="https://facebook.com/wearevalleychurch" target="_blank" aria-label="Facebook"><i class="fa fa-lg u-text-white fa-facebook-official"></i></a>&nbsp;
              <a href="https://instagram.com/valley_church" target="_blank" aria-label="Instagram"><i class="fa fa-lg u-text-white fa-instagram"></i></a>
            </p>
          </div>

          <div class="o-col-12@xxs o-col-9@lg u-grid-0@xxs u-grid-1@lg u-margin u-hide u-show@sm">
            <div class="o-row">
              <div class="o-col-12@xxs o-col-6@xs o-col-3@sm">
                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">New Here?</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-new-here',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>

                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">Services</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-services',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>

              <div class="o-col-12@xxs o-col-6@xs o-col-3@sm">
                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">Church Life</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-church-life',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>

              <div class="o-col-12@xxs o-col-6@xs o-col-3@sm">
                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">Watch &amp; Read</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-watch-read',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>

                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">Get Involved</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-get-involved',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>

              <div class="o-col-12@xxs o-col-6@xs o-col-3@sm">
                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">People Matter</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-people-matter',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>

                <h6 class="u-text-muted u-margin-quarter u-text-uppercase">Venue Hire</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-venue-hire',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <p class="small u-text-muted u-text-center@xs u-text-left@lg u-margin-none">
            &copy; <?= date( 'Y' ) ?> <?= bloginfo( 'name' ); ?>. We're a <a href="http://freemethodist.org.uk" target="_blank">Free Methodist UK Church</a>, <a href="http://apps.charitycommission.gov.uk/Showcharity/RegisterOfCharities/CharityWithoutPartB.aspx?RegisteredCharityNumber=1125080&SubsidiaryNumber=0"
              target="_blank">Registered Charity No. 1125080</a>. <a href="/privacy">Privacy &amp; Cookie Policy</a>.
          </p>
        </div>
      </div>
    </footer>

    <?php if ( $_SERVER['HTTP_HOST'] === "valley.dev" ) {
      $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://'; ?>
    <script src="<?= $protocol . $_SERVER['HTTP_HOST']; ?>:35729/livereload.js"></script>
    <?php } ?>

    <?php wp_footer(); ?>
  </body>
</html>
