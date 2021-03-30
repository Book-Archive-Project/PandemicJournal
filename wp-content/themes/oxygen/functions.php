<?php

function my_theme_enqueue_styles() {
    $parent_style = 'dogchannel_enqueue_styles'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.min.css');
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style( 'lightbox', get_stylesheet_directory_uri() . '/css/lightbox.css');
    wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css');
    wp_enqueue_style( 'preset1', get_stylesheet_directory_uri() . '/css/presets/preset1.css');
    wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css');

    wp_enqueue_style( 'responsive1', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');


    wp_enqueue_script( 'customjs1', get_stylesheet_directory_uri() . '/js/html5shiv.js', true );
    wp_enqueue_script('customj2', get_stylesheet_directory_uri().'/js/respond.min.js' );
    wp_enqueue_script( 'customjs3', get_stylesheet_directory_uri() . '/js/jquery.js', true );
    wp_enqueue_script( 'customjs4', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', true );
    wp_enqueue_script( 'customjs5', get_stylesheet_directory_uri() . '/js/jquery.inview.min.js', true );
    wp_enqueue_script( 'customjs6', get_stylesheet_directory_uri() . '/js/wow.min.js', true );
    wp_enqueue_script( 'customjs7', get_stylesheet_directory_uri() . '/js/mousescroll.js', true );
    wp_enqueue_script( 'customjs8', get_stylesheet_directory_uri() . '/js/smoothscroll.js', true );
    wp_enqueue_script( 'customjs9', get_stylesheet_directory_uri() . '/js/jquery.countTo.js', true );
    wp_enqueue_script( 'customjs10', get_stylesheet_directory_uri() . '/js/lightbox.min.js', true );
    wp_enqueue_script( 'customjs11', get_stylesheet_directory_uri() . '/js/main.js', true );


}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


