<section class="haim-slide">

<?php 
$banner = new WP_Query(array('post_type' => 'banner', 'posts_per_page' => -1)); 
while($banner->have_posts()) : $banner->the_post(); ?>

<?php the_post_thumbnail();?>

<div class="haim-slide__mask">
    <div class="container">
        <?php the_content() ?>
    </div>
</div>

<?php endwhile; wp_reset_query(); ?>
</section>