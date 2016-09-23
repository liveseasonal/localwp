<?php $sidebar = voyage_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php voyage_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkdf-container">
		<?php do_action('voyage_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner clearfix">
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
		<?php do_action('voyage_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>