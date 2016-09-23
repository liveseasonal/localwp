<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<?php voyage_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<?php voyage_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<div class="mkdf-post-info">
					<?php voyage_mikado_post_info(array(
						'date'     => 'yes',
						'category' => 'yes',
						'comments' => 'yes',
						'like'     => 'yes'
					)) ?>
				</div>
				<?php
				voyage_mikado_excerpt($excerpt_length);
				$args_pages = array(
					'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
					'after'       => '</div></div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '%'
				);

				wp_link_pages($args_pages);
				?>
			</div>
			<div class="mkdf-author-desc clearfix">
				<div class="mkdf-image-name">
					<div class="mkdf-author-image">
						<?php echo voyage_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
					</div>
					<div class="mkdf-author-name-holder">
						<h5 class="mkdf-author-name">
							<?php
							if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
								echo esc_attr(get_the_author_meta('first_name'))." ".esc_attr(get_the_author_meta('last_name'));
							} else {
								echo esc_attr(get_the_author_meta('display_name'));
							}
							?>
						</h5>
					</div>
				</div>
				<div class="mkdf-share-icons">
					<?php $post_info_array['share'] = voyage_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
					<?php echo voyage_mikado_get_social_share_html(array(
						'type'      => 'list',
						'icon_type' => 'normal',
						'show_label' => 'no'
					)); ?>
				</div>
			</div>
		</div>
	</div>
</article>