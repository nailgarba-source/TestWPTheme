<?php
$id = 'hero-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}
$className = 'hero-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
$hero_image = get_field('hero_image');
$title = get_field('title');
$subtitle = get_field('subtitle');
$cta_text = get_field('cta_text');
$cta_url = get_field('cta_url');
?>

<div id="<?php echo esc_attr($id); ?>" class="hero-block">
    <div class="hero-left">
        <h1><?php echo esc_html($title); ?></h1>
        <h3><?php echo esc_html($subtitle); ?></h3>
        <button class="hero-cta">
            <a href="<?php echo esc_html($cta_url['url']); ?>" aria-label="<?php echo esc_html($cta_url['title']); ?>"
                class="cta-button">
                <p><?php echo esc_html($cta_text); ?></p>
            </a>
        </button>
    </div>

    <div class="hero-right">
        <?php if ($hero_image): ?>
            <img class="hero-image" src="<?php echo esc_url($hero_image['url']); ?>"
                alt="<?php echo esc_attr($title); ?>" />
        <?php endif; ?>
    </div>
</div>