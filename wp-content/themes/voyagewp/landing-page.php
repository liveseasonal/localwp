<?php
/*
Template Name: Landing Page
*/
$sidebar = voyage_mikado_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * voyage_mikado_header_meta hook
	 *
	 * @see voyage_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable_meta() - hooked with 10
	 */
	if(!voyage_mikado_is_ajax_request()) {
		do_action('voyage_mikado_header_meta');
	}
	?>

	<?php if(!voyage_mikado_is_ajax_request()) {
		wp_head();
	} ?>
</head>

<body <?php body_class(); ?>>

<?php
if((!voyage_mikado_is_ajax_request()) && voyage_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") {
	$ajax_class = 'mkdf-mimic-ajax';
	?>
	<div class="mkdf-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
		<div class="mkdf-st-loader">
			<div class="mkdf-st-loader1">
	            <?php echo voyage_mikado_loading_spinners(true); ?>
			</div>
		</div>
	</div>
<?php } ?>

<div class="mkdf-wrapper">
	<div class="mkdf-wrapper-inner">
		<div class="mkdf-content">
			<?php if(voyage_mikado_is_ajax_enabled()) { ?>
				<div class="mkdf-meta">
					<?php do_action('voyage_mikado_ajax_meta'); ?>
					<span id="mkdf-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>

					<div class="mkdf-body-classes"><?php echo esc_html(implode(',', get_body_class())); ?></div>
				</div>
			<?php } ?>
			<div class="mkdf-content-inner">
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
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>