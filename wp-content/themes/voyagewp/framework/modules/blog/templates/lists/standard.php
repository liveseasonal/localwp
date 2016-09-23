<div class="mkdf-blog-holder mkdf-blog-type-standard <?php echo esc_attr($blog_classes) ?>" data-blog-type="<?php echo esc_attr($blog_type) ?>" <?php echo esc_attr(voyage_mikado_set_blog_holder_data_params()); ?> >
	<?php
	if($blog_query->have_posts()) : while($blog_query->have_posts()) : $blog_query->the_post();
		voyage_mikado_get_post_format_html($blog_type);
	endwhile;
	else:
		voyage_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
	endif;
	?>
	<?php
	if(voyage_mikado_options()->getOptionValue('pagination') == 'yes') {
		voyage_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
	}
	?>
</div>
