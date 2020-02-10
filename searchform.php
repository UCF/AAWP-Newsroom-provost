  <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="input-group search-input">
  	<input type="search" class="form-control" placeholder="Search the newsroom" value="<?php echo get_search_query() ?>" name="s" title="Search" />
    <button type="submit" class="search-submit btn btn-primary" title="Search Button"><i class="fa fa-search" aria-hidden="true"></i> </button>

  </form>
