<?php

function test1(){
 add_theme_support('title-tag');
 add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'test1');

function my_theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());

}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
