    </main>

    <footer class="c-footer u-clearfix">
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
              <li class="small">&copy; <?= date( 'Y' ); ?> <?= bloginfo( 'name' ); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <?php if( $_SERVER['HTTP_HOST'] === "valley.dev" || $_SERVER['HTTP_HOST'] === "lanpc130" ) {
      $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://'; ?>
    <script src="<?= $protocol . $_SERVER['HTTP_HOST']; ?>:35729/livereload.js"></script>
    <?php } ?>

    <?php wp_footer(); ?>

  </body>
</html>
