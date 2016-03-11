<?php require_once "../../../../wp-load.php"; ?>
<?php include "partials/header.php"; ?>

        <section class="o-container c-section">

          <div class="o-row">

            <div class="o-col-xxs-12 o-col-lg-11 u-center-block">

              <div class="o-row">

                <article class="o-col-xxs-12 o-col-md-8 c-article u-margin">
                  <h1 class="u-margin--half">Tools</h1>
                  <p class="lead u-margin--quadruple">Tools define a number of reusable features and functions for use across the site. They're defined at the top of the stack so they can be inherited everywhere.</p>

                  <h3 id="functions">Functions</h3>

                  <p id="grayscale" class="lead u-margin--none"><strong>grayscale($gradation, $alpha)</strong></p>
                  <p>Returns a grayscale value defined in <a href="settings"><code>$VCgrayscale-colours</code></a>. <code>$gradation</code> is any number between 1 and 10. <code>$alpha</code> is optional and can be anything between <code>0.0</code> and <code>1.0</code> in <code>0.05</code> increments.</p>

                  <p id="color" class="lead u-margin--none"><strong>color($name, [$shade, $alpha])</strong></p>
                  <p>Returns a colour value defined in <a href="settings"><code>$VCcolours</code></a>. When only <code>$name</code> is passed, the base shade is returned. The optional <code>$shade</code> parameter can be one of the following:</p>
                  <ul>
                    <li>x-dark</li>
                    <li>dark</li>
                    <li>base</li>
                    <li>light</li>
                    <li>x-light</li>
                  </ul>

                  <p id="strip-units" class="lead u-margin--none"><strong>strip-units($number)</strong></p>
                  <p>Return a unitless number</p>

                  <p id="quarter" class="lead u-margin--none"><strong>quarter($n)</strong></p>
                  <p>Divides a value by 4</p>

                  <p id="half" class="lead u-margin--none"><strong>half($n)</strong></p>
                  <p>Divides a value by 2</p>

                  <p id="three-quarters" class="lead u-margin--none"><strong>three-quarters($n)</strong></p>
                  <p>Multiplies a value by .75</p>

                  <p id="double" class="lead u-margin--none"><strong>double($n)</strong></p>
                  <p>Multiplies a value by 2</p>

                  <p id="quadruple" class="lead u-margin--none"><strong>quadruple($n)</strong></p>
                  <p class="u-margin--quadruple">Multiplies a value by 4</p>


                  <h3 id="mixins">Mixins</h3>

                  <p id="breakpoint" class="lead u-margin--none"><strong>breakpoint($bp, $rule: <code>min-width</code>)</strong></p>
                  <p>Creates a media query for the corresponding <code>$bp</code> given (from values defined in <a href="settings"><code>$VCbreakpoints</code></a>. <code>$rule</code> defaults to <code>min-width</code> but will work if <code>max-width</code> is passed. For example:</p>

<pre><code class="language-css">/* Sass */
@include breakpoint(md) {
  .o-btn {
    max-width: auto;
  }
}

/* Compiled CSS */
@media screen and (min-width: 50rem) {
  .o-btn {
    max-width: auto;
  }
}</code></pre>

                  <p id="font-stack" class="lead u-margin--none"><strong>font-stack($alternates: true)</strong></p>
                  <p>Includes the default font stack defined in <a href="settings"><code>$VCfont-stack</code></a>. If <code>$alternates</code> are enabled, this will include appropriate stylistic sets for the typeface.</p>

<pre><code class="language-css">/* Sass */
body {
  @include font-stack;
}

/* Compiled CSS */
body {
  font-family: "LatoWeb", "Open Sans", "Helvetica Neue", Arial, sans-serif;
  text-rendering: optimizeLegibility;
}
</code></pre>

                  <p id="font-stack-alt" class="lead u-margin--none"><strong>font-stack-alt($alternates: true)</strong></p>
                  <p>Same as above but for the alternative font stack defined in <a href="settings"><code>$VCfont-stack</code></a>. If <code>$alternates</code> are enabled, this will include appropriate stylistic sets for the typeface.</p>

<pre><code class="language-css">/* Sass */
h1 {
  @include font-stack-alt;
}

/* Compiled CSS */
h1 {
  font-family: "usual", LatoWeb", "Open Sans", "Helvetica Neue", Arial, sans-serif;
  text-rendering: optimizeLegibility;
}
</code></pre>

                  <p id="clearfix" class="lead u-margin--none"><strong>clearfix()</strong></p>
                  <p>Includes the micro clearfix hack.</p>

<pre><code class="language-css">/* Sass */
.o-row {
  @include clearfix;
}

/* Compiled CSS */
.o-row::after {
  content: "";
  display: table;
  clear: both;
}
</code></pre>

                  <p id="center-block" class="lead u-margin--none"><strong>center-block()</strong></p>
                  <p>Includes CSS to position the div centrally.</p>

<pre><code class="language-css">/* Sass */
.o-container {
  @include center-block;
}

/* Compiled CSS */
.o-container::after {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</code></pre>

                  <p id="pull-left" class="lead u-margin--none"><strong>pull-left()</strong></p>
                  <p>Includes <code>float: left</code>.</p>

<pre><code class="language-css">/* Sass */
.class {
  @include pull-left;
}

/* Compiled CSS */
.class {
  float: left;
}
</code></pre>

                  <p id="pull-right" class="lead u-margin--none"><strong>pull-right()</strong></p>
                  <p>Includes <code>float: right</code>.</p>

<pre><code class="language-css">/* Sass */
.class {
  @include pull-right;
}

/* Compiled CSS */
.class {
  float: right;
}
</code></pre>

                  <p id="full-height" class="lead u-margin--none"><strong>full-height()</strong></p>
                  <p>Includes <code>height: 100%</code>.</p>

<pre><code class="language-css">/* Sass */
.class {
  @include full-height;
}

/* Compiled CSS */
.class {
  height: 100%;
}
</code></pre>

                  <p id="transition" class="lead u-margin--none"><strong>transition($property: <code>all</code>, $timing: <code>$VCtransition-timing</code>, $easing: <code>$VCtransition-easing</code>)</strong></p>
                  <p>Create a transition for any element. Pass any transitionable CSS property into <code>$property</code> (defaults to <code>all</code>).</p>

<pre><code class="language-css">/* Sass */
a {
  @include transition(color);
}

/* Compiled CSS */
a {
  transform: translateZ(0);
  transition: color 150ms ease-in-out;
}
</code></pre>

                  <p id="box-shadow" class="lead u-margin--none"><strong>box-shadow($x-spacing: <code>0</code>, $y-spacing: <code>0</code>, $blur: <code>25px</code>, $spread: <code>0</code>, $colour: <code>rgba(0,0,0,.1)</code>)</strong></p>
                  <p>Creates a CSS box shadow with defaults that can be overwritten.</p>

<pre><code class="language-css">/* Sass */
.o-card--shadow {
  @include box-shadow;
}

/* Compiled CSS */
.o-card--shadow {
  box-shadow: 0 0 25px 0 rgba(0,0,0,0.1);
}
</code></pre>

                  <p id="text-shadow" class="lead u-margin--none"><strong>text-shadow($x-spacing: <code>0</code>, $y-spacing: <code>0</code>, $blur: <code>2px</code>, $colour: <code>black</code>)</strong></p>
                  <p>Creates a CSS text shadow with defaults that can be overwritten.</p>

<pre class="u-margin--quadruple"><code class="language-css">/* Sass */
h1 {
  @include text-shadow;
}

/* Compiled CSS */
h1 {
  text-shadow: 0 0 2px black;
}
</code></pre>

                  <h3 id="animations">Animations</h3>

                  <p id="fadeInFromNone" class="lead u-margin--none"><strong>fadeInFromNone</strong></p>
                  <p>An animation to assist with showing and hiding the side navigation.</p>

<pre class="u-margin--quadruple"><code class="language-css">.c-navigation--toggle {
  .is-menu-active & {
    animation: fadeInFromNone $VCtransition-timing $VCtransition-easing;
  }
}</code></pre>

                  <h3 id="grid" class="u-margin--half">Grid</h3>
                  <p>Grid system taken from <a href="http://v4-alpha.getbootstrap.com" target="_blank">Bootstrap v4</a>.</p>

                  <p id="make-container" class="lead u-margin--none"><strong>make-container($gutter: <code>$VCgrid-gutter</code>)</strong></p>
                  <p>Creates rules for a container class.</p>

                  <p id="make-row" class="lead u-margin--none"><strong>make-row($gutter: <code>$VCgrid-gutter</code>)</strong></p>
                  <p>Creates rules for a row class.</p>

                  <p id="make-col" class="lead u-margin--none"><strong>make-col($size, $columns: <code>$VCgrid-columns</code>, $gutter: <code>$VCgrid-gutter</code>)</strong></p>
                  <p>Creates rules for a column class. <code>$size</code> takes an <code>$i</code>-style number in a loop.</p>

                  <p id="make-col-offset" class="lead u-margin--none"><strong>make-col-offset($size, $columns: <code>$VCgrid-columns</code>)</strong></p>
                  <p>Autogenerate classes for column offsets.</p>

                  <p id="make-col-push" class="lead u-margin--none"><strong>make-col-push($size, $columns: <code>$VCgrid-columns</code>)</strong></p>
                  <p>Autogenerate push classes for column offsets.</p>

                  <p id="make-col-pull" class="lead u-margin--none"><strong>make-col-pull($size, $columns: <code>$VCgrid-columns</code>)</strong></p>
                  <p>Autogenerate pull classes for column offsets.</p>

                  <p id="make-col-modifier" class="lead u-margin--none"><strong>make-col-modifier($type, $size, $columns: <code>$VCgrid-columns</code>)</strong></p>
                  <p class="u-margin--quadruple">Autogenerate modifier classes in a loop for column offsets.</a>.</p>

                  <h3 id="grid-framework">Grid Framework</h3>

                  <p id="make-grid-columns" class="lead u-margin--none"><strong>make-grid-columns($columns: <code>$VCgrid-columns</code>, $gutter: <code>$VCgrid-gutter</code>, $breakpoints: <code>$VCbreakpoints</code>)</strong></p>
                  <p class="u-margin--quadruple">Creates rules for column classes.</p>

                  <h3 id="modular-scale" class="u-margin--half"><a href="https://github.com/modularscale/modularscale-sass" target="_blank">Modular Scale</a></h3>
                  <p class="lead u-margin--none">Tools for helping to create a typographic rhythm.</p>
                </article>

                <aside class="o-col-xxs-12 o-col-md-4 o-col-lg-3 o-col-lg--push-1 u-margin">
                  <h5>In this section</h5>
                  <ul class="o-list">
                    <li>
                      <a href="#functions">Functions</a>
                      <ul class="o-list">
                        <li><a href="#grayscale">grayscale</a></li>
                        <li><a href="#color">color</a></li>
                        <li><a href="#strip-units">strip-units</a></li>
                        <li><a href="#quarter">quarter</a></li>
                        <li><a href="#half">half</a></li>
                        <li><a href="#three-quarters">three-quarters</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#mixins">Mixins</a>
                      <ul class="o-list">
                        <li><a href="#breakpoint">breakpoint</a></li>
                        <li><a href="#font-stack">font-stack</a></li>
                        <li><a href="#font-stack-alt">font-stack-alt</a></li>
                        <li><a href="#clearfix">clearfix</a></li>
                        <li><a href="#center-block">center-block</a></li>
                        <li><a href="#pull-left">pull-left</a></li>
                        <li><a href="#pull-right">pull-right</a></li>
                        <li><a href="#full-height">full-height</a></li>
                        <li><a href="#transition">transition</a></li>
                        <li><a href="#box-shadow">box-shadow</a></li>
                        <li><a href="#text-shadow">text-shadow</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#animations">Animations</a>
                      <ul class="o-list">
                        <li><a href="#fadeInFromNone">fadeInFromNone</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#grid">Grid</a>
                      <ul class="o-list">
                        <li><a href="#make-container">make-container</a></li>
                        <li><a href="#make-row">make-row</a></li>
                        <li><a href="#make-col">make-col</a></li>
                        <li><a href="#make-col-offset">make-col-offset</a></li>
                        <li><a href="#make-col-push">make-col-push</a></li>
                        <li><a href="#make-col-pull">make-col-pull</a></li>
                        <li><a href="#make-col-modifier">make-col-modifier</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#grid-framework">Grid Framework</a>
                      <ul class="o-list">
                        <li><a href="#make-grid-columns">make-grid-columns</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#modular-scale">Modular Scale</a>
                    </li>
                  </ul>
                </aside>

              </div>

            </div>

          </div>

        </section>

<?php include "partials/footer.php"; ?>
