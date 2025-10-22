<?php
// Get the flexible content field
$pet_love = get_field('pet_love');

if ($pet_love):
    foreach ($pet_love as $row):
        if ($row['acf_fc_layout'] === 'moments'): // Layout name must match the one defined in ACF
            $moment_name = $row['moment_name'];
            $moment_pics = $row['moment_pics']; // This is an array of images
            $editorial = $row['editorial'];
            ?>
            
            <div class="moment-block">
                <?php if ($moment_name): ?>
                    <h2 class="moment-title"><?php echo esc_html($moment_name); ?></h2>
                <?php endif; ?>

                <?php if ($moment_pics && is_array($moment_pics)): ?>
                    <div class="moment-gallery">
                        <?php foreach ($moment_pics as $image): ?>
                            <img
                                class="moment-image"
                                src="<?php echo esc_url($image['url']); ?>"
                                alt="<?php echo esc_attr($image['alt']); ?>"
                            />
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($editorial): ?>
                    <div class="moment-editorial">
                        <?php echo wp_kses_post($editorial); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php
        endif;
    endforeach;
endif;
?>
