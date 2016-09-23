<li <?php post_class('mkdf-blog-list-item clearfix'); ?>>
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
			<<?php echo esc_html($title_tag) ?> class="mkdf-item-title">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php echo esc_attr(get_the_title()) ?>
			</a>
		</<?php echo esc_html($title_tag) ?>>

		<?php if($text_length != '0') {
			$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
			<p class="mkdf-excerpt"><?php echo esc_html($excerpt) ?></p>
		<?php } ?>

		<div class="mkdf-item-info-section">
			<?php voyage_mikado_post_info(array(
				'date'     => 'yes',
				'category' => 'no',
				'author'   => 'no',
				'comments' => 'yes',
				'like'     => 'yes'
			)) ?>
		</div>
	</div>
	</div>
</li>