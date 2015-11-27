    </main>

    <footer class="c-footer u-clearfix">
      <div class="o-container">
        <div class="o-row u-margin">
          <div class="o-col-xs-12 o-col-sm-3 u-margin">
            <?php //get_template_part( 'partials/logo' ); ?>
          </div>
          <div class="o-col-xs-12 o-col-sm-3 u-margin">
            <h4>About</h4>
            <?php wp_nav_menu( array(
              'theme_location' => 'Footer 1',
              'menu' => 'Footer 1',
              'fallback_cb' => false,
              'container' => false,
              'menu_class' => 'c-menu-footer u-cf'
            ) ); ?>
          </div>
          <div class="o-col-xs-12 o-col-sm-3 u-margin">
            <h4>Locations</h4>
            <?php wp_nav_menu( array(
              'theme_location' => 'Footer 2',
              'menu' => 'Footer 2',
              'fallback_cb' => false,
              'container' => false,
              'menu_class' => 'c-menu-footer u-cf'
            ) ); ?>
          </div>
          <div class="o-col-xs-12 o-col-sm-3 u-margin">
            <h4>Next Steps</h4>
            <?php wp_nav_menu( array(
              'theme_location' => 'Footer 3',
              'menu' => 'Footer 3',
              'fallback_cb' => false,
              'container' => false,
              'menu_class' => 'c-menu-footer u-cf'
            ) ); ?>
          </div>
        </div>
        <div class="o-row">
          <hr/>
          <div class="o-col-xs-12">
            <p class="small">&copy; <?php echo date('Y') ?> <?php bloginfo( 'name' ); ?> &bull; <a href="http://freemethodist.org.uk" target="_blank">A Free Methodist UK Church</a> &bull; <a href="http://www.charitycommission.gov.uk/search-for-a-charity/?txt=1125080" target="_blank">Registered Charity No. 1125080</a> &bull; <a href="/privacy">Privacy &amp; Cookie Policy</a></p>
          </div>
        </div>
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>