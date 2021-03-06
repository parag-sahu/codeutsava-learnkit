<?php
/**
* This is a sample functions php to add some 
* functionality and tweaks.
**/
if(!function_exists('cupss_theme_setup')){
    /**
    * Add theme features on theme initialization 
    */
    function cupss_theme_setup(){
        /**
        * Add the title featutre to the wordpress theme.
        * By this the theme automatically adds title to 
        * the page when wp_head() is called in header.
        */
        add_theme_support( 'title-tag' );
        /**
        * Add a custom logo option to the wordpress theme
        * which was first done by a lot of tweaks. Requires
        * WP 4.5+ 
        */
        add_theme_support( 'custom-logo' );
        /**
        * Enable feed for the RSS feed for posts you
        * write and comments you get.
        */
        add_theme_support( 'automatic-feed-links' );
        /**
        * Enables post formats in the posts.
        */
        //delete-it: Remove the post types that are not needed by the theme.
        add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );
        /**
        * Enable post types to have thumbnails. 
        */
        //delete-it: Add the custom post types you need thumbnail in.
        add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
        /**
        * Make wordpress generate HTML5 tags on its core
        * elements that are generated from its function.
        */
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    }
}
add_action( 'after_setup_theme', 'cupss_theme_setup');
/**
* Adding backwards compatiblity for the 
* feature title-tag
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
/**
* $content_width allows us to set max width for
* oEmbeds and images used in the posts.
*/
if ( ! isset( $content_width ) )
	$content_width = 1920;
/**
* Add some lines of code to the head of every
* file using wp_head action
*/
function cupss_add_html_to_head(){
    /**
    * Adds a magic responsive tag to every page of the wordpress site.
    */
    ?>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php
    
    /**
    * Add further scripts that are much required like google analytics!
    *
    * ---------------------left as a placeholder for further editing
    *
    */
}
add_action( 'wp_head', 'cupss_add_html_to_head' );
/**
* Add print statements for post header. 
* Uses action ps_post_header.
*/
function ps_post_head(){
    ?>
    <?php if(is_single()||is_page()):?>
        <h1><?php the_title(); ?></h1>
    <?php else: ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
    <?php endif;?>   
    <p>Written by: <?php the_author_posts_link(); ?></p>
    <?php edit_post_link('edit', '<p>', '</p>'); ?>
    <p><?php the_time('F jS, Y'); ?></p>
    <?php
}
add_action( 'ps_post_header','ps_post_head' );
/**
* Execute some lines of code in post footer.
* Uses action ps_post_footer
*/
function ps_post_foot(){
    ?>
    <?php  if(is_single()||is_page()):
        do_action('ps_author_details');
        comments_template();
        endif;
    ?>
    <?php
}
add_action( 'ps_post_footer','ps_post_foot' );
/**
* Print out details of author.
* uses action ps_author_details
*/
function ps_print_author_meta(){
    ?>
    <article>
        <header>
            <figure>
                <?php echo get_avatar(get_the_author_meta('ID')); ?>
            </figure>
            <?php if(is_author()):?>
                <h1><?php the_author_meta('display_name');?></h1>
            <?php else:?>
                <h3><?php the_author_posts_link(); ?></h3>
            <?php endif;?>
        </header>
    <p><?php the_author_meta('user_description');?></p>
    </article>
    <?php
}
add_action('ps_author_details', 'ps_print_author_meta');
/**
* Register menus for the theme.
*/
function cupss_register_menu() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
    )
  );
}
add_action( 'init', 'cupss_register_menu' );
/**
    * To add stylesheets to the head of the document 
    */
    function cupss_register_styles() {
        wp_register_style( 'site-css', get_stylesheet_directory_uri().'/css/style.css');
        wp_enqueue_script( 'site-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
        wp_enqueue_style( 'site-css' );
    }
    add_action('wp_enqueue_scripts', 'cupss_register_styles');
/**
* Customize excerpt using 'excerpt_more' filter.
*/
function cupss_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'cupss_excerpt_more' );
/**
* An action to add pagination.
*/
function ps_post_pagination(){
    the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( 'New', 'textdomain' ),
	'next_text' => __( 'Older', 'textdomain' ),
) );
}
add_action( 'ps_pagination', 'ps_post_pagination' );


function cupss_tutorial_post_type() {

	$labels = array(
		'name'                  => 'Tutorials',
		'singular_name'         => 'Tutorial',
		'menu_name'             => 'Tutorials',
		'name_admin_bar'        => 'Tutorial',
		'archives'              => 'Item Archives',
		'parent_item_colon'     => 'Parent Tutorial:',
		'all_items'             => 'All Tutorials',
		'add_new_item'          => 'Add New Tutorial',
		'add_new'               => 'Add New',
		'new_item'              => 'New Tutorial',
		'edit_item'             => 'Edit Tutorial',
		'update_item'           => 'Update Tutorial',
		'view_item'             => 'View Tutorial',
		'search_items'          => 'Search Tutorial',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into Tutorial',
		'uploaded_to_this_item' => 'Uploaded to this Tutorial',
		'items_list'            => 'Items list',
		'items_list_navigation' => 'Items list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Tutorial',
		'description'           => 'Add new tutorial to list them for ordering food.',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'tutorial', $args );

}
 add_action( 'init', 'cupss_tutorial_post_type', 0 );

 // Register Custom Taxonomy
function cupps_add_branches() {

	$labels = array(
		'name'                       => 'Branches',
		'singular_name'              => 'Branch',
		'menu_name'                  => 'Branch',
		'all_items'                  => 'All Branches',
		'parent_item'                => 'Parent Branch',
		'parent_item_colon'          => 'Parent Branch:',
		'new_item_name'              => 'New Branch Name',
		'add_new_item'               => 'Add New Branch',
		'edit_item'                  => 'Edit Branch',
		'update_item'                => 'Update Branch',
		'view_item'                  => 'View Branch',
		'separate_items_with_commas' => 'Separate branches with commas',
		'add_or_remove_items'        => 'Add or remove branch',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Branches',
		'search_items'               => 'Search Branches',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No branch',
		'items_list'                 => 'Branches list',
		'items_list_navigation'      => 'Branches list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'branch', array( 'tutorial' ), $args );

}
add_action( 'init', 'cupps_add_branches', 0 ); // Register Custom Taxonomy
function cupps_add_subjects() {

	$labels = array(
		'name'                       => 'Subjects',
		'singular_name'              => 'Subject',
		'menu_name'                  => 'Subject',
		'all_items'                  => 'All Subjects',
		'parent_item'                => 'Parent Subject',
		'parent_item_colon'          => 'Parent Subject:',
		'new_item_name'              => 'New Subject Name',
		'add_new_item'               => 'Add New Subject',
		'edit_item'                  => 'Edit Subject',
		'update_item'                => 'Update Subject',
		'view_item'                  => 'View Subject',
		'separate_items_with_commas' => 'Separate subject with commas',
		'add_or_remove_items'        => 'Add or remove subject',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Subjects',
		'search_items'               => 'Search subjects',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No subject',
		'items_list'                 => 'Subjects list',
		'items_list_navigation'      => 'Subjects list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'subject', array( 'tutorial' ), $args );

}
add_action( 'init', 'cupps_add_subjects', 0 );