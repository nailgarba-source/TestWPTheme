<?php
function my_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('site-icon');
    add_theme_support('custom-logo', [
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    register_nav_menu('header_menu', 'Header Menu');
    register_nav_menu('footer_menu', 'Footer Menu');

}
add_action('after_setup_theme', 'my_theme_setup');

function my_theme_enqueue_styles()
{
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_register_acf_blocks()
{
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


function testtheme_enqueue_block_styles()
{
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

add_action( 'init', 'bookstore_register_book_post_type' );
function bookstore_register_book_post_type() {
    $args = array(
        'labels' => array(
            'name'          => 'Books',
            'singular_name' => 'Book',
            'menu_name'     => 'Books',
            'add_new'       => 'Add New Book',
            'add_new_item'  => 'Add New Book',
            'new_item'      => 'New Book',
            'edit_item'     => 'Edit Book',
            'view_item'     => 'View Book',
            'all_items'     => 'All Books',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'book', $args );
}

add_action( 'init', 'bookstore_register_book_post_type' );


remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',5);
function show_hello_shortcode() {
    return "<p>Hello from a shortcode!</p>";
}
add_shortcode('hello', 'show_hello_shortcode');

function random_woocommerce_product_shortcode($atts) {
    if (!class_exists('WooCommerce')) return '<p>WooCommerce not active.</p>';

    $atts = shortcode_atts([
        'limit' => 5,
    ], $atts, 'random_product');

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ];

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '<p>No products found.</p>';
    }

    $output = '<div class="random-products-marquee">';
    $output .= '<div class="random-products-track">';

    for ($i = 0; $i < 2; $i++) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            $output .= '<div class="random-product">';
            $output .= '<a href="' . get_permalink() . '">';
            $output .= $product->get_image();
            $output .= '<h2>' . get_the_title() . '</h2>';
            $output .= '</a>';
            $output .= '<p>' . $product->get_price_html() . '</p>';
            $output .= '</div>';
        }
        $query->rewind_posts();
    }

    $output .= '</div></div>';

    wp_reset_postdata();

    return $output;
}
add_shortcode('random_product', 'random_woocommerce_product_shortcode');

add_shortcode('random_product', 'random_woocommerce_product_shortcode');


function display_plant_features_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => get_the_ID(),
    ], $atts, 'plant_features');

    $post_id = intval($atts['id']);

    if (!function_exists('get_field')) {
        return '<p>ACF plugin not active.</p>';
    }

    $features = get_field('plant_features', $post_id);

    if (empty($features)) {
        return '<p>No plant features found.</p>';
    }

    $output = '<div class="plant-features">';

    foreach ($features as $row) {
        if ($row['acf_fc_layout'] === 'features') {
            $color = esc_html($row['color']);
            $height = esc_html($row['height']);

            $output .= '<div class="plant-feature">';
            $output .= '<p><strong>Color:</strong> ' . $color . '</p>';
            $output .= '<p><strong>Height:</strong> ' . $height . '</p>';
            $output .= '</div>';
        }
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('plant_features', 'display_plant_features_shortcode');

add_action('rest_api_init', function () {
    register_rest_route(
        'myplugin/v1',
        '/random-product',
        array(
            'methods'  => 'GET',
            'callback' => 'my_random_product_callback',
            'permission_callback' => '__return_true',
        )
    );
});

function my_random_product_callback($data) {
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );

    $query = new WP_Query($args);
    $products = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            $products[] = array(
                'title' => get_the_title(),
                'price' => $product->get_price(),
                'link'  => get_permalink(),
            );
        }
        wp_reset_postdata();
    }

    return $products;
}
