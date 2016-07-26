    </main>

    <!-- <footer class="c-footer u-cf">
      <div class="o-container o-container--full">
        <div class="o-row">
          <div class="o-col-xxs-12 o-col-sm-9 u-text-center--xxs u-text-left--sm">
            <ul class="o-list o-list--inline u-margin u-margin--sm--none">
              <li><a class="small" href="http://freemethodist.org.uk" target="_blank">A Free Methodist UK Church</a></li>
              <li><a class="small" href="http://apps.charitycommission.gov.uk/Showcharity/RegisterOfCharities/CharityWithoutPartB.aspx?RegisteredCharityNumber=1125080&SubsidiaryNumber=0" target="_blank">Registered Charity No. 1125080</a></li>
              <li><a class="small" href="/privacy">Privacy &amp; Cookie Policy</a></li>
            </ul>
          </div>
          <div class="o-col-xxs-12 o-col-sm-3 u-text-center--xxs u-text-right--sm">
            <ul class="o-list o-list--inline u-margin u-margin--sm--none">
              <li class="small">&copy; <?= date( 'Y' ) ?> <?= bloginfo( 'name' ); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </footer> -->

    <footer class="c-footer u-cf">
      <div class="o-container u-padding-top u-padding-bottom">
        <div class="o-row">

          <div class="o-col-xxs-12 o-col-lg-3 u-text-center--xxs u-text-left--lg u-grid-1--xxs u-grid-0--lg u-margin">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/dist/logo.svg" class="u-margin c-logo">
            <p class="small u-text-muted u-line-height--small">
              Fourfields<br/>
              Bamber Bridge<br/>
              Preston<br/>
              Lancashire<br/>
              PR5 6GS
            </p>
            <p class="small">
              <i class="fa fa-fw fa-phone"></i> <a href="tel:+441772696717">01772 696717</a><br/>
              <i class="fa fa-fw fa-envelope"></i> <a href="mailto:general@valleychurch.eu">general@valleychurch.eu</a>
            <p>
              <a href="https://twitter.com/valley_church" target="_blank"><i class="fa fa-lg u-text-white fa-twitter"></i></a>&nbsp;
              <a href="https://facebook.com/wearevalleychurch" target="_blank"><i class="fa fa-lg u-text-white fa-facebook-official"></i></a>&nbsp;
              <a href="https://instagram.com/valley_church" target="_blank"><i class="fa fa-lg u-text-white fa-instagram"></i></a>
            </p>
          </div>

          <div class="o-col-xxs-12 o-col-lg-9 u-grid-0--xxs u-grid-1--lg u-margin">
            <div class="o-row">
              <div class="o-col-xxs-12 o-col-xs-6 o-col-sm-3">
                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">New Here?</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-new-here',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>

                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">Services</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-services',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>

              <div class="o-col-xxs-12 o-col-xs-6 o-col-sm-3">
                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">Church Life</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-church-life',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>

              <div class="o-col-xxs-12 o-col-xs-6 o-col-sm-3">
                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">Watch &amp; Read</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-watch-read',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>

                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">Get Involved</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-get-involved',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>
              </div>

              <div class="o-col-xxs-12 o-col-xs-6 o-col-sm-3">
                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">People Matter</h6>
                <?php wp_nav_menu( array(
                  'theme_location' => 'footer-people-matter',
                  'container' => false,
                  'menu_class' => 'o-list small u-margin',
                  'fallback_cb' => false
                ) ); ?>

                <h6 class="u-text-muted u-margin--quarter u-text-uppercase">Venue Hire</h6>
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
          <p class="small u-text-muted u-text-center--xs u-text-left--lg">
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
