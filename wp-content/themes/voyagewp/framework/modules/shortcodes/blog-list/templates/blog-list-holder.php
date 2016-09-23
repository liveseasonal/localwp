<div <?php voyage_mikado_class_attribute($holder_classes); ?>>
	<ul class="mkdf-blog-list">
		<?php if($type == 'masonry') { ?>
			<li class="mkdf-blog-list-masonry-grid-sizer"></li>
			<li class="mkdf-blog-list-masonry-grid-gutter"></li>
		<?php }
		$html = '';
		if($query_result->have_posts()):
			while($query_result->have_posts()) : $query_result->the_post();
				$html .= voyage_mikado_get_shortcode_module_template_part('templates/'.$type, 'blog-list', '', $params);
			endwhile;
			print $html;
		else: ?>
			<div class="mkdf-blog-list-messsage">
				<p><?php esc_html_e('No posts were found.', 'voyage'); ?></p>
			</div>
		<?php endif;
		wp_reset_postdata();
		?>
	</ul>
</div>
