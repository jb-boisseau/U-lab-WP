<form role="search" name="sbsearch" method="get" class="" action="<?php echo esc_url(home_url('/')); ?>">
    <ul>
        <li class="field">
            <label class="hide"><?php _e('Search for:', 'wpgumby'); ?></label>
            <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" placeholder="<?php _e('Search', 'wpgumby'); ?>" class="search input ten columns" name="s">
            <a href="#" onclick="document.forms['sbsearch'].submit(); return false;" class="two columns"><i class="icon-search">&nbsp;</i></a>
        </li>
    </ul>
</form>