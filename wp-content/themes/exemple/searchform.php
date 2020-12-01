<form class="form-inline my-2 my-lg-0 " role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" value="<?php echo get_search_query(); ?>" name="s">
    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
</form>