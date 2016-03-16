<?php require_once "../../../../wp-load.php"; ?>
<?php include "partials/header.php"; ?>

        <section class="o-container c-section">

          <div class="o-row">

            <div class="o-col-xxs-12 o-col-lg-11 u-center-block">

              <div class="o-row">

                <article class="o-col-xxs-12 o-col-md-8 c-article u-margin">
                  <h1 class="u-margin--half">Settings</h1>
                  <p class="lead u-margin--quadruple">A central file for controlling the look and feel of the site</p>

                  <h3 id="variables">Variables</h3>
<pre class="u-margin--quadruple"><code class="language-css"><?= file_get_contents( get_template_directory_uri() . '/assets/styles/sass/settings/_variables.scss' ); ?></code></pre>

                  <h3 id="fonts" class="u-margin--half">Fonts</h3>
                  <p>Loads local font files for Lato.</p>

                </article>

                <aside class="o-col-xxs-12 o-col-md-4 o-col-lg-3 o-col-lg--push-1 u-margin">
                  <h5>In this section</h5>
                  <ul class="o-list">
                    <li><a href="#variables">Variables</a></li>
                    <li><a href="#fonts">Fonts</a></li>
                  </ul>
                </aside>

              </div>

            </div>

          </div>

        </section>

<?php include "partials/footer.php"; ?>
