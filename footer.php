    </main>

    <footer class="c-footer u-cf">
      <div class="o-container">
        <div class="o-row">

          <div class="o-col-12@xxs u-text-center@xxs u-text-left@lg" itemscope itemtype="http://schema.org/LocalBusiness">
            <p class="small u-text-muted u-margin-half">
              <img src="<?= get_template_directory_uri(); ?>/assets/images/dist/touchicon.png" alt="Valley Church icon" class="u-hidden" itemprop="image">
              <span itemprop="name"><?= bloginfo('name'); ?>, </span>
              <span itemscope itemprop="address" itemtype="http://schema.org/PostalAddress">
                <span itemprop="streetAddress">Fourfields, Bamber Bridge,</span> <span itemprop="addressLocality">Preston,</span> <span itemprop="addressRegion">Lancashire,</span> <span itemprop="postalCode">PR5 6GS</span> &bull; <span itemprop="telephone" content="+441772696717"><a href="tel:01772696717">01772 696717</a></span> &bull; <span itemprop="email"><a href="mailto:general@valleychurch.eu">general@valleychurch.eu</a></span>
              </span>
            </p>
          </div>

          <div class="o-col-12@xxs u-text-center@xxs u-text-left@lg">
            <p class="small u-text-muted u-margin-none">
              &copy; <?= date('Y') ?> <?= bloginfo('name'); ?> &bull; We're a <a href="http://freemethodist.org.uk" target="_blank">Free Methodist UK Church</a>, <a href="http://apps.charitycommission.gov.uk/Showcharity/RegisterOfCharities/CharityWithoutPartB.aspx?RegisteredCharityNumber=1125080&SubsidiaryNumber=0"
                target="_blank">Registered Charity No. 1125080</a> &bull; <a href="/privacy">Privacy Policy</a> &bull; <a href="/cookies">Cookie Policy</a>
            </p>
          </div>

        </div>
      </div>
    </footer>

    <!-- Cookie popup -->
    <?php get_template_part('partials/cookies'); ?>

    <?php wp_footer(); ?>
  </body>
</html>
