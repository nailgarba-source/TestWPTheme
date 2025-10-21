<?php 


$socials = get_field('social_icons', 'option');
$phone_number = get_field('phone_number', 'option');
$address = get_field('address', 'option');

?>


<footer class="site-footer">
    <div class="address"><?php echo esc_html($address);?></div>
    <div class="phone_number"><?php echo esc_html($phone_number);?></div>
    <?php foreach ($socials as $social){ ?>
        <a href="<?php echo esc_url($social['url']); ?>" 
            class="footer-social-icon-link">
            <img class="footer-social-icon-image" src="<?php echo esc_url($social['icon']['url']); ?>"
                />
        </a>
    <?php } ?>

    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>