<?php get_template_part('templates/global/html','header'); ?>
<section class="haim-page">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <header class="haim-header--internal">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </header>
    <div class="haim-content">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>
    <?php endwhile; endif; wp_reset_query(); ?>
</section>
<?php get_template_part('templates/global/html','newsletter'); ?>
<?php get_template_part('templates/global/html','footer'); ?>