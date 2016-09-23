<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <?php mkdf_tours_get_single_tour_item(); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
