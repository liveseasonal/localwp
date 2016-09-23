<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$sidebar = voyage_mikado_sidebar_layout(); ?>

<?php get_header(); ?>
<?php voyage_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

<div class="mkdf-full-width">
<div class="mkdf-full-width-inner">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="mkdf-grid-row-medium-gutter">
			<div <?php echo voyage_mikado_get_content_sidebar_class(); ?>>
				<?php the_content(); ?>
				<?php do_action('voyage_mikado_page_after_content'); ?>
			</div>

			<?php if(!in_array($sidebar, array('default', ''))) : ?>
				<div <?php echo voyage_mikado_get_sidebar_holder_class(); ?>>
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endwhile; endif; ?>
</div>
</div>
<?php get_footer(); ?>