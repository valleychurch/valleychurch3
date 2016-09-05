<form role="search" method="get" id="searchform" class="c-search" action="<?= home_url( '/' ); ?>">
  <label for="s" class="u-hidden">Search</label>
  <input type="search" id="s" name="s" value="<?php the_search_query(); ?>" placeholder="Search..." class="c-search__input u-margin-none" />
  <button aria-label="Search" type="submit" id="searchsubmit" class="o-btn c-search__button">
    <i class="fa fa-search" aria-hidden="true"></i>
  </button>
</form>
