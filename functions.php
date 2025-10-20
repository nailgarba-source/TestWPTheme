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

function myblocks_blockone_block_init() {
		register_block_type( __DIR__ . "/build/blockone" );
}
add_action('init', 'myblocks_blockone_block_init');


add_action('acf/init', 'register_my_acf_block');
function register_my_acf_block() {
    acf_register_block_type(array(
        'name'              => 'custom-block',
        'title'             => __('My Custom Block'),
        'description'       => __('A custom ACF block.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/custom-block.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'custom' ),
        'mode'              => 'auto', // or 'preview' or 'edit'
        'supports'          => array(
            'align' => false,
            'mode' => true,
        ),
    ));
}

// add_action('acf/init', 'my_acf_block_init');
