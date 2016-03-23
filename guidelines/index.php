<?php require_once "../../../../wp-load.php"; ?>
<?php include "partials/header.php"; ?>

        <figure class="c-featured">
          <picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(min-width: 70rem)" srcset="https://cdn.valleychurch.eu/wp-content/uploads/2016/03/guidelines-2000x800.jpg">
            <source media="(min-width: 40rem)" srcset="https://cdn.valleychurch.eu/wp-content/uploads/2016/03/guidelines-1280x608.jpg">
            <source srcset="https://cdn.valleychurch.eu/wp-content/uploads/2016/03/guidelines-640x360.jpg">
            <!--[if IE 9]></video><![endif]-->
            <img srcset="https://cdn.valleychurch.eu/wp-content/uploads/2016/03/guidelines-2000x800.jpg" alt="Guidelines" width="2000" height="800">
          </picture>
        </figure>


        <section class="o-container c-section">

          <article class="o-row c-article u-margin">

            <div class="o-col-xxs-12 c-post-content u-center-block">
              <h1>Dev guidelines v<?= VC_THEME_VERSION; ?></h1>
              <p class="lead">
                This documentation is meant to serve as a guide for how to develop well for the <a href="http://valleychurch.eu">valleychurch.eu</a> WordPress theme and other web properties.
              </p>

              <p>
                The theme is built using Sass (SCSS syntax) and Javascript, compiled with Grunt. Instructions on how to set up a local development environment are included on <a href="GetStarted.php">Get Started</a> to get you up and running quickly.
              </p>

              <p>
                Development structure mostly follows guidance set out by <a href="http://codeguide.co/" target="_blank">@mdo's Code Guide</a> and <a href="https://speakerdeck.com/dafed/managing-css-projects-with-itcss" target="_blank">Harry Roberts' ITCSS</a> so please read them both!
              </p>
            </div>

          </article>

        </section>

<?php include "partials/footer.php"; ?>
