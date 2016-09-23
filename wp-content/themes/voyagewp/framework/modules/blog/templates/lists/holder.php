<div class="mkdf-grid-row-medium-gutter">
	<div <?php echo voyage_mikado_get_content_sidebar_class(); ?>>
		<?php voyage_mikado_get_blog_type($blog_type); ?>
	</div>

	<?php if(!in_array($sidebar, array('default', ''))) : ?>
		<div <?php echo voyage_mikado_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
</div>

