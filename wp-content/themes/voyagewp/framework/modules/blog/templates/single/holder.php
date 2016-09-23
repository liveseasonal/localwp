<div class="mkdf-grid-row-medium-gutter">
	<div <?php echo voyage_mikado_get_content_sidebar_class(); ?>>
		<div class="mkdf-blog-holder mkdf-blog-single <?php echo esc_attr($single_template); ?>">
			<?php voyage_mikado_get_single_html(); ?>
		</div>
	</div>

	<?php if(!in_array($sidebar, array('default', ''))) : ?>
		<div <?php echo voyage_mikado_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
</div>