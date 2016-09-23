<li <?php post_class('mkdf-blog-list-item mkdf-blog-list-masonry-item clearfix'); ?>>
	<div class="mkdf-blog-list-item-inner">
		<?php if(!$hide_image) : ?>
			<div class="mkdf-item-image">
				<a href="<?php echo esc_url(get_permalink()) ?>">
					<?php if($use_custom_image_size) : ?>
						<?php echo voyage_mikado_generate_thumbnail(
							get_post_thumbnail_id(get_the_ID()),
							null,
							$custom_image_dimensions[0],
							$custom_image_dimensions[1]
						); ?>
					<?php else: ?>
						<?php the_post_thumbnail($thumb_image_size); ?>
					<?php endif; ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="mkdf-item-text-holder">
			<div class="mkdf-item-date">
				<?php the_time(get_option('date_format')); ?>
			</div>
			<<?php echo esc_html($title_tag) ?> class="mkdf-item-title">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php echo esc_attr(get_the_title()) ?>
			</a>
		</<?php echo esc_html($title_tag) ?>>

		<?php if($text_length != '0') {
			$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
			<p class="mkdf-excerpt"><?php echo esc_html($excerpt) ?></p>
		<?php } ?>

		<div class="mkdf-post-item-author-holder">
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">

					<span class="mkdf-post-item-author-avatar-holder">
						<?php echo voyage_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 30)); ?>
					</span>

					<span class="mkdf-post-item-author-name">
						<?php
						if(get_the_author_meta('first_name') !== '' || get_the_author_meta('last_name') !== '') {
							echo esc_html(get_the_author_meta('first_name')).' '.esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_html(get_the_author_meta('display_name'));
						} ?>
					</span>
			</a>
		</div>
	</div>
	</div>
</li>