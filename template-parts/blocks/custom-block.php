<?php
// Get ACF fields
$title = get_field('pro_fields_test');
$content = get_field('test_2');
?>
 
<div class="custom-block">
    <h2><?php echo esc_html($title); ?></h2>
    <div><?php echo wp_kses_post($content); ?></div>
</div>
<?php if ($title || $content): ?>
    <div class="custom-block">
        <?php if ($title): ?>
            <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        
        <?php if ($content): ?>
            <div><?php echo wp_kses_post($content); ?></div>
        <?php endif; ?>
    </div>
<?php endif; ?>