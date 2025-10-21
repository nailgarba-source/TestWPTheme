<?php
$id = 'favorite-food-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}
$className = 'favorite-food-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$favorite_foods = get_field('favorite_foods');
?>

<div id="<?php echo esc_attr($id); ?>" class="favorite-food-block">
    <?php foreach ($favorite_foods as $food): ?>
        <?php
        $name = $food['name'];
        $description = $food['description'];
        $rating = intval($food['rating']);
        $image = $food['image'];
        ?>

        <div class="swiper-slide">
            <div class="food-item">
                <div class="hero-right">
                    <?php if ($image): ?>
                        <img class="hero-image" src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($name); ?>" />
                    <?php endif; ?>
                </div>
                <h3><?php echo esc_html($name); ?></h3>
                <p><?php echo esc_html($description); ?></p>

                <div class="rating-bar-wrapper">
                    <div class="rating-bar" style="width: <?php echo $rating; ?>%;"></div>
                </div>
                <p class="rating-label"><?php echo $rating; ?>/100</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>