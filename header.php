<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
    <title><?php bloginfo('name'); ?></title>
</head>
<?php
$logo = get_field('logo', 'option');
?>

<body <?php body_class(); ?>>
    <header class="site-heading">

            <a href="<?php echo esc_url(get_home_url()); ?>">
                <?php if ($logo): ?>
                    <img src="<?php echo esc_url($logo['url']) ?>" class="header-logo"/>
                <?php else: ?>
                    <h1 class="blog-title"><?php bloginfo('name'); ?></h1>
                <?php endif; ?>
            </a>

        <nav class="site-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header_menu',
                'menu_class' => 'header-menu',
                'container' => false,
            ));
            ?>
        </nav>
    </header>
