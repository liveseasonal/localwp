<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<div class="mkdf-post-mark">
					<span aria-hidden="true" class="icon_quotations"></span>
				</div>
				<div class="mkdf-post-info">
					<?php voyage_mikado_post_info(array('date' => 'yes', 'like' => 'yes', 'comments' => 'yes')) ?>
				</div>
				<div class="mkdf-post-title">
					<h3>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_quote_text_meta", true)); ?></a>
					</h3>
					<span class="quote_author">&mdash; <?php the_title(); ?></span>
				</div>
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
		<?php the_content(); ?>
	</div>
</article>