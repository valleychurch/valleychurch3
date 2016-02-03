      </main>

      <footer class="c-footer u-clearfix small">
        <div class="o-container">
          <div class="o-row">
            <div class="o-col-xxs-12 o-col-sm-9 u-text-center--xxs u-text-left--sm">
              <ul class="o-list c-footer__menu u-margin u-margin--sm--none">
                <li><a href="http://freemethodist.org.uk" target="_blank">A Free Methodist UK Church</a></li>
                <li><a href="http://apps.charitycommission.gov.uk/Showcharity/RegisterOfCharities/CharityWithoutPartB.aspx?RegisteredCharityNumber=1125080&SubsidiaryNumber=0" target="_blank">Registered Charity No. 1125080</a></li>
                <li><a href="/privacy">Privacy &amp; Cookie Policy</a></li>
              </ul>
            </div>
            <div class="o-col-xxs-12 o-col-sm-3 u-text-center--xxs u-text-right--sm">
              <p class="u-margin--none">&copy; <?php echo date( 'Y' ) ?> <?php bloginfo( 'name' ); ?></p>
            </div>
          </div>
        </div>
      </footer>

    </div> <!-- .container -->

    <!-- IE fixes -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/dist/respond.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/dist/rem.min.js"></script>
    <![endif]-->

    <?php wp_footer(); ?>

    <?php // if ( strpos($_SERVER['HTTP_HOST'], 'valleychurch') === false ) { ?>
    <!--<script src="//<?php echo $_SERVER['HTTP_HOST']; ?>:35729/livereload.js"></script>-->
    <?php // } ?>

  </body>
</html>