<?php
/**
 * Single Product Template
 *
 * @package MyTheme
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<main id="primary" class="site-main container py-8">

    <?php
    while ( have_posts() ) :
        the_post();
    ?>
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="product-images">
                    <?php
                    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
                    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 4);
                    add_action('woocommerce_single_product_summary', function() {
                        echo '<p class="custom-note">Free shipping on orders over 5000NGN!</p>';
                    }, 15);
                    ?>
                </div>

                <div class="product-summary">
                    <?php
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>

            </div>
            <div class="product-tabs mt-12">
                <?php
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>

        </div>

    <?php endwhile; ?>

</main>

<?php
get_footer();
