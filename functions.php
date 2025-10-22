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




function my_theme_register_acf_blocks() {
/**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    // Define the directory containing the blocks.
    $blocks_directory = get_template_directory() . '/template-parts/blocks';

    // Check if the directory exists.
    if (!is_dir($blocks_directory)) {
        return;
    }

    // Get all subdirectories (assuming each block is in its own folder).
    $block_folders = glob($blocks_directory . '/*', GLOB_ONLYDIR);

    // Loop through each block folder and register the block.
    foreach ($block_folders as $block_folder) {
        $block_json = $block_folder . '/block.json';

        // Check if block.json exists in the folder.
        if (file_exists($block_json)) {
            register_block_type($block_folder);
        }
    }
}
add_action('init', 'my_theme_register_acf_blocks');


function testtheme_enqueue_block_styles() {
    $blocks_dir = get_template_directory() . '/template-parts/blocks';
    $blocks_url = get_template_directory_uri() . '/template-parts/blocks';

    // Get all subdirectories (each representing a block)
    $block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);

    foreach ($block_folders as $block_folder) {
        $style_path = $block_folder . '/style.css';

        if (file_exists($style_path)) {
            $block_name = basename($block_folder); // e.g., "hero", "testimonial"
            $style_handle = 'testtheme-' . $block_name;

            wp_enqueue_style(
                $style_handle,
                $blocks_url . '/' . $block_name . '/style.css',
                array(),
                filemtime($style_path)
            );
        }
    }
}
add_action('enqueue_block_assets', 'testtheme_enqueue_block_styles');


function mytheme_register_menus() {
    register_nav_menu('header_menu', 'Header Menu');
    register_nav_menu('footer_menu', 'Footer Menu');
}
add_action('after_setup_theme', 'mytheme_register_menus');

