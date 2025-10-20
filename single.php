<?php get_header();?>


<?php
while (have_posts()) {
    the_post(); ?>

    <div>
        <h2>"><?php the_title(); ?></h2>
        <div class="content"><?php the_content()?></div>
    <?php }


    ?>

    <?php get_footer(); ?>