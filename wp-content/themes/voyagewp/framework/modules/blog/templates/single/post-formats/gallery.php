<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<?php voyage_mikado_get_module_template_part('templates/single/parts/gallery', 'blog'); ?>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<?php voyage_mikado_get_module_template_part('templates/single/parts/title', 'blog'); ?>
				<div class="mkdf-post-info">
					<?php voyage_mikado_post_info(array('date' => 'yes', 'like' => 'yes', 'comments' => 'yes')) ?>
				</div>
				<?php the_content(); ?>
			</div>
			<div class="mkdf-category-share-holder clearfix">
				<div class="mkdf-category-holder">
					<div class="mkdf-category">
						<span aria-hidden="true" class="icon_tags"></span><?php the_category(', '); ?>
					</div>
				</div>
				<div class="mkdf-share-icons-single">
					<?php $post_info_array['share'] = voyage_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
					<?php if($post_info_array['share'] == 'yes'): ?>
						<span class="mkdf-share-label"><?php esc_html_e('Share', 'voyage'); ?></span>
					<?php endif; ?>
					<?php echo voyage_mikado_get_social_share_html(array(
						'type'      => 'list',
						'icon_type' => 'normal'
					)); ?>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('voyage_mikado_before_blog_article_closed_tag'); ?>
</article>