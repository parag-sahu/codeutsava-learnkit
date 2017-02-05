<?php
    get_header();
    if(have_posts()):
    ?><h1>Here are the search result for:<?php the_search_query(); ?></h1><?php
        while(have_posts()):the_post();
            
            get_template_part( 'format', get_post_format() );
        endwhile;
        do_action('ps_pagination');
        else:
            get_template_part( 'format', 'none' );
    endif;
    get_footer();