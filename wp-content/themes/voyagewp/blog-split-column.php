<?php
/*
	Template Name: Blog: Split Column
*/
?>
<?php get_header(); ?>
<?php voyage_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkdf-container">
		<?php do_action('voyage_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner">
			<?php voyage_mikado_get_blog('split-column'); ?>
		</div>
		<?php do_action('voyage_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>