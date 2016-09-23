<?php get_header(); ?>
	<div class="mkdf-tours-search-page-holder">
		<div class="mkdf-container">
			<div class="mkdf-container-inner">
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-9">
						<?php echo mkdf_tours_get_search_ordering_html(); ?>

						<?php echo mkdf_tours_get_search_page_content_html(); ?>
					</div>
					<div class="mkdf-grid-col-3">
						<aside class="mkdf-sidebar">
							<div class="widget mkdf-tours-main-search-filters">
								<?php echo mkdf_tours_get_search_main_filters_html(); ?>
							</div>

							<div class="widget mkdf-tours-tour-type-filters">
								<?php echo mkdf_tours_get_tour_type_filters_html(); ?>
							</div>

							<?php dynamic_sidebar('tour-search-sidebar'); ?>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
