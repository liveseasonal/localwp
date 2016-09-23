<?php if(is_array($tours_list) && count($tours_list)) : ?>

	<?php foreach($tours_list as $tour_item) : ?>
		<?php
		global $post;

		$post = $tour_item;
		setup_postdata($tour_item);
		?>

		<div class="<?php echo esc_attr($col_class); ?> mkdf-tours-gallery-with-hover mkdf-tours-item-with-smaller-spacing mkdf-tours-search-item">
			<?php echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$type, 'tours', '', '', array(
				'thumb_size' => $thumb_size,
				'text_length' => $text_length,
				'title_style' => ''
			)); ?>
		</div>
	<?php endforeach; ?>

<?php else: ?>
	<p><?php esc_html_e('We haven\'t found any tour that mathes you\'re criteria', 'mikado-tours'); ?></p>
<?php endif; ?>
