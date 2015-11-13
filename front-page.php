<?php get_header(); ?>

<div class="o-container">
  <div class="o-row">
    <div class="o-col-xs-12 o-col-md-8 o-col-md--offset-2">

      <h1>This is the primary heading and there should only be one of these per page</h1>
      <figure class="c-avatar c-avatar--xl">
        <img src="http://i.imgur.com/VRgezU3.jpg" alt="Rick Butterfield" />
      </figure>
      <figure class="c-avatar c-avatar--no-img c-avatar--xl" data-initials="VC">
        <!-- <img src="http://i.imgur.com/0tRX9MO.jpg" alt="Daniel Eden" /> -->
      </figure>
      <p class="lead">This is a <strong>lead paragraph</strong>. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      <p>A small paragraph to <em>emphasise</em> and show <strong>important</strong> bits.</p>
      <ul>
        <li>This is a list item</li>
        <li>So is this - there could be more</li>
        <li>Make sure to style list items to:
          <ul>
            <li>Not forgetting child list items</li>
            <li>Not forgetting child list items</li>
            <li>Not forgetting child list items</li>
            <li>Not forgetting child list items</li>
          </ul>
        </li>
        <li>A couple more</li>
        <li>top level list items</li>
      </ul>
      <p>Don't forget <strong>ordered lists</strong>:</p>
      <ol>
       <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
       <li>Aliquam tincidunt mauris eu risus.
        <ol>
          <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
          <li>Aliquam tincidunt mauris eu risus.</li>
        </ol>
      </li>
      <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
      <li>Aliquam tincidunt mauris eu risus.
      </li></ol>
      <h2>A sub heading which is not as important as the first, but is quite imporant overall</h2>
      <p>Pellentesque habitant morbi tristique <a href="#0">senectus et netus et malesuada fames ac turpis egestas</a>. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      <table>
        <tbody><tr>
          <th>Table Heading</th>
          <th>Table Heading</th>
        </tr>
        <tr>
          <td>table data</td>
          <td>table data</td>
        </tr>
        <tr>
          <td>table data</td>
          <td>table data</td>
        </tr>
        <tr>
          <td>table data</td>
          <td>table data</td>
        </tr>
        <tr>
          <td>table data</td>
          <td>table data</td>
        </tr>
      </tbody></table>

      <h3>A sub heading which is not as important as the second, but should be used with consideration</h3>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      <blockquote><p>“Ooh - a blockquote! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.”</p></blockquote>
      <h4>A sub heading which is not as important as the second, but should be used with consideration</h4>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      <pre><code>#header h1 a {
        display: block;
        width: 300px;
        height: 80px;
      }</code></pre>
      <h5>A sub heading which is not as important as the second, but should be used with consideration</h5>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      <dl>
       <dt>Definition list</dt>
       <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
        commodo consequat.</dd>
        <dt>Lorem ipsum dolor sit amet</dt>
        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
          commodo consequat.</dd>
        </dl>
        <h6>This heading plays a relatively small bit part role, if you use it at all</h6>
        <p><small>And this denotes small text</small></p>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <hr/>
        <h6>Forms</h6>
        <form>
          <label>
            Email address
          </label>
          <input type="email" placeholder="come@me.bro" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">

          <div class="o-row">

            <div class="o-col-xs-12 o-col-sm-6">
              <label>
                Password
              </label>
              <input placeholder="Keep it secret." type="password">
            </div>

            <div class="o-col-xs-12 o-col-sm-6">
              <label>
                Confirm password
              </label>
              <input placeholder="Keep it safe." type="password">
            </div>

            <div class="o-col-xs-12 o-col-sm-6">
              <label>
                Disabled field
              </label>
              <input type="text" value="This is disabled" disabled>
            </div>

            <div class="o-col-xs-12 o-col-sm-6">
              <label>
                Textarea
              </label>
              <textarea>Edit me, yo</textarea>
            </div>

            <div class="o-col-xs-12 o-col-sm-4">
              <label>
                First name <span class="u-font-error">(Required)</span>
              </label>
              <input type="text" class="is-invalid">
            </div>

            <div class="o-col-xs-12 o-col-sm-4">
              <label>
                Last name
              </label>
              <input type="text" class="is-valid" value="Housten">
            </div>

            <div class="o-col-xs-12 o-col-sm-4">
              <label>
                Country
              </label>
              <select>
                <option>United Kingdom</option>
                <option>United States</option>
                <option>Something else</option>
              </select>
            </div>

            <div class="o-col-sm-12">
              <button type="submit" class="o-btn">
                Submit
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>

  <?php get_footer(); ?>