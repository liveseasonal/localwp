<?php
/*
Template Name: WooCommerce
*/
?>
<?php

global $woocommerce;

$id      = get_option('woocommerce_shop_page_id');
$shop    = get_post($id);
$sidebar = voyage_mikado_sidebar_layout();

if(get_post_meta($id, 'mkd_page_background_color', true) != '') {
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'mkd_page_background_color', true));
} else {
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'mkd_content-top-padding', true) != '') {
	if(get_post_meta($id, 'mkd_content-top-padding-mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'mkd_content-top-padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'mkd_content-top-padding', true)).'px';
	}
}

if(get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif(get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

get_header();

voyage_mikado_get_title();
get_template_part('slider');

$full_width = false;

if(voyage_mikado_options()->getOptionValue('mkdf_woo_products_list_full_width') == 'yes' && !is_singular('product')) {
	$full_width = true;
}

if($full_width) { ?>
<div class="mkdf-full-width" <?php voyage_mikado_inline_style($background_color); ?>>
	<?php } else { ?>
	<div class="mkdf-container" <?php voyage_mikado_inline_style($background_color); ?>>
		<?php }
		if($full_width) { ?>
		<div class="mkdf-full-width-inner" <?php voyage_mikado_inline_style($content_style); ?>>
			<?php } else { ?>
			<div class="mkdf-container-inner clearfix" <?php voyage_mikado_inline_style($content_style); ?>>
				<?php }

				//Woocommerce content
				if(!is_singular('product')) {

					switch($sidebar) {

						case 'sidebar-33-right': ?>
							<div class="mkdf-two-columns-66-33 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1">
									<div class="mkdf-column-inner">
										<?php voyage_mikado_woocommerce_content(); ?>
									</div>
								</div>
								<div class="mkdf-column2">
									<?php get_sidebar(); ?>
								</div>
							</div>
							<?php
							break;
						case 'sidebar-25-right': ?>
							<div class="mkdf-two-columns-75-25 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1 mkdf-content-left-from-sidebar">
									<div class="mkdf-column-inner">
										<?php voyage_mikado_woocommerce_content(); ?>
									</div>
								</div>
								<div class="mkdf-column2">
									<?php get_sidebar(); ?>
								</div>
							</div>
							<?php
							break;
						case 'sidebar-33-left': ?>
							<div class="mkdf-two-columns-33-66 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1">
									<?php get_sidebar(); ?>
								</div>
								<div class="mkdf-column2">
									<div class="mkdf-column-inner">
										<?php voyage_mikado_woocommerce_content(); ?>
									</div>
								</div>
							</div>
							<?php
							break;
						case 'sidebar-25-left': ?>
							<div class="mkdf-two-columns-25-75 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1">
									<?php get_sidebar(); ?>
								</div>
								<div class="mkdf-column2 mkdf-content-right-from-sidebar">
									<div class="mkdf-column-inner">
										<?php voyage_mikado_woocommerce_content(); ?>
									</div>
								</div>
							</div>
							<?php
							break;
						default:
							voyage_mikado_woocommerce_content();
					}

				} else {
					voyage_mikado_woocommerce_content();
				} ?>

			</div>
		</div>
		<?php get_footer(); ?>
