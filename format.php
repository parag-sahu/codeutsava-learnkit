<article id="<?php the_id(); ?>" <?php post_class(); ?>>
    <header>
    <?php do_action( 'ps_post_header' ) ?>
    </header>
        <?php
        if ( has_post_thumbnail() ) {
	the_post_thumbnail();
} 
        if(is_single()||is_page()):
            the_content();
        else:
            the_excerpt();
        endif;
        ?>
    <footer>
        <?php do_action( 'ps_post_footer' ); ?>
    </footer>
</article>