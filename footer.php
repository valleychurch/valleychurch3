      </main>

      <footer class="c-footer u-clearfix">
        <div class="o-container">
          <p class="small u-margin--none">&copy; <?php echo date( 'Y' ) ?> <?php bloginfo( 'name' ); ?> &bull; <a href="http://freemethodist.org.uk" target="_blank">A Free Methodist UK Church</a> &bull; <a href="http://www.charitycommission.gov.uk/search-for-a-charity/?txt=1125080" target="_blank">Registered Charity No. 1125080</a> &bull; <a href="/privacy">Privacy &amp; Cookie Policy</a></p>
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

    <?php if ( strpos($_SERVER['HTTP_HOST'], 'valleychurch') === false ) { ?>
    <script src="//<?php echo $_SERVER['HTTP_HOST']; ?>:35729/livereload.js"></script>
    <?php } ?>

  </body>
</html>