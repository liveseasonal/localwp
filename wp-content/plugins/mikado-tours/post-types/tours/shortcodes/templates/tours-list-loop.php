<?php while($query->have_posts()) : ?>
	<?php $query->the_post(); ?>

	<div <?php post_class('mkdf-tour-list-item-inner'); ?>>
		<?php $caller->getItemTemplate($tour_type, $params); ?>
	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>