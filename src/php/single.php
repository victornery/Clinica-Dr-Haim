<?php get_template_part('templates/global/html','header'); ?>
<section class="haim-page">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <header class="haim-header--internal">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <?php if(is_singular('cirurgias')): ?>
                <span>Detalhes sobre a cirurgia</span>
            <?php endif; ?>
            <?php if(is_singular('procedimentos')): ?>
                <span>Detalhes sobre o procedimento</span>
            <?php endif; ?>
        </div>
    </header>

    <div class="haim-content">
        <div class="container">
            <?php the_content(); ?>
        </div>

            <?php $video = get_post_meta($post->ID, 'video-about', true) ?>
    <?php if($video): ?>
        <div class="video-especialidades">
            <div class="container">
                <iframe width="100%" height="415" src="https://www.youtube.com/embed/<?php echo $video ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">

            <?php if(is_singular('cirurgias')): ?>
                <h2 class="haim-content__title">Outras cirurgias</h2>
            <?php endif; ?>
            <?php if(is_singular('procedimentos')): ?>
                <h2 class="haim-content__title">Outros procedimentos</h2>
            <?php endif; ?>
            <ul class="haim-procedures__list haim-procedures__list--internal">
            <?php if(is_singular('cirurgias')): ?>
                <?php $cirurgias = new WP_Query(array('post_type' => 'cirurgias', 'posts_per_page' => 4, 'orderby' => 'rand')); ?>
                <?php while($cirurgias->have_posts()) : $cirurgias->the_post(); ?>
                    <li class="haim-procedures__item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="haim-procedures__mask"></div>
                            <?php the_post_thumbnail('full'); ?>
                            <span><?php the_title(); ?></span>
                        </a>
                    </li>
                <?php $i++; endwhile; wp_reset_query(); ?>
            <?php endif;?>

            <?php if(is_singular('procedimentos')): ?>
                <?php $procedures = new WP_Query(array('post_type' => 'procedimentos', 'posts_per_page' => 4, 'orderby' => 'rand')); ?>
                <?php while($procedures->have_posts()) : $procedures->the_post(); ?>
                    <li class="haim-procedures__item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="haim-procedures__mask"></div>
                            <?php the_post_thumbnail('full'); ?>
                            <span><?php the_title(); ?></span>
                        </a>
                    </li>
                <?php $i++; endwhile; wp_reset_query(); ?>
            <?php endif;?>
            </ul>
        </div>
    </div>
    <?php endwhile; endif; wp_reset_query(); ?>
</section>
<?php get_template_part('templates/global/html','footer'); ?>