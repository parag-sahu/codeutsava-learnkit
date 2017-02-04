<?php 
    get_header();
    $args = array( 'post_type' => 'tutorial');
    $loop = new WP_Query( $args );
    if($loop->have_posts()):
        while($loop->have_posts()):$loop->the_post();
            get_template_part( 'format', get_post_format() );
        endwhile;
        do_action('ps_pagination');
        else:
            get_template_part( 'format', 'none' );
    endif;
    get_footer();