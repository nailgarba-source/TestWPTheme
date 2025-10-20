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


function my_acf_block_init() {
    // Check if function exists
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'custom_block',
            'title'             => __('Custom Block'),
            'description'       => __('A custom block created with ACF.'),
            'render_template'   => 'template-parts/blocks/custom-block.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('custom', 'block'),
        ));
    }
}
add_action('acf/init', 'my_acf_block_init');
