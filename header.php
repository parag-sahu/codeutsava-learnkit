<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>"> 
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="c-header">
        <?php the_custom_logo(); ?>
    
        <?php get_search_form( ); ?>
           <span class="hamburger hamburger--spin">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </span>
        <section id="cupss-menu"><?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav','menu_class' => 'cupss-menu' ) ); ?></section>
        
    </header>
    <main id="c-main">