<?php get_header(); ?>

<?php voyage_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

	<div class="mkdf-container">
		<?php do_action('voyage_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner clearfix">
			<div class="mkdf-tours-search-page-holder">
				<div class="mkdf-grid-row-medium-gutter">
					<div class="mkdf-grid-col-9">
						<?php echo mkdf_tours_get_search_ordering_html(); ?>

						<?php echo mkdf_tours_get_search_page_content_html(); ?>

						<?php echo mkdf_tours_get_search_pagination(); ?>
					</div>
					<div class="mkdf-grid-col-3">
						<aside class="mkdf-sidebar">
							<div class="widget mkdf-tours-main-search-filters">
								<?php echo mkdf_tours_get_search_main_filters_html(); ?>
							</div>

							<?php dynamic_sidebar('tour-search-sidebar'); ?>
						</aside>
					</div>
				</div>
			</div>
		</div>
		<?php do_action('voyage_mikado_before_container_close'); ?>
	</div>

<?php get_footer(); ?>
