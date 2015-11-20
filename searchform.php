<form role="search" method="get" id="searchform" class="c-search" action="<?php echo home_url( '/' ); ?>">
  <div class="o-flag o-flag--rev">
    <div class="o-flag__flex">
      <label for="s" class="u-hidden">Search</label>
      <input type="search" id="s" name="s" value="" placeholder="Search..." class="c-search__input u-margin--none" />
    </div>
    <div class="o-flag__fix">
      <button aria-label="Search" type="submit" id="searchsubmit" class="o-btn c-search__button">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</form>