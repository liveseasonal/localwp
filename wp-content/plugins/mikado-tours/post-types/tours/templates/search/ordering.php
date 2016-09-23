<div class="mkdf-search-ordering-holder">
	<div class="mkdf-search-ordering-items-holder">
		<ul class="mkdf-search-ordering-list">
			<?php foreach($ordering as $order_key => $order_value) : ?>
				<?php
				$is_active_order_item = $current_ordering === $order_value['order_by'] && $current_order_type == $order_value['order_type'];
				$active_class = $is_active_order_item ? 'mkdf-search-ordering-item-active' : '';

				?>

				<li class="mkdf-search-ordering-item <?php echo esc_attr($active_class); ?>" data-order-by="<?php echo esc_attr($order_value['order_by']); ?>" data-order-type="<?php echo esc_attr($order_value['order_type']) ?>">
					<a href="#">
						<i class="mkdf-search-ordering-icon <?php echo esc_attr($order_value['icon']); ?>"></i><!--
					--><span><?php echo esc_html($order_value['title']); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
			<li class="mkdf-tab-line"></li>
		</ul>
	</div>

	<div class="mkdf-tours-search-view-types-holder">
		<ul class="mkdf-tours-search-view-list">
			<?php foreach($view_types as $view_type) : ?>
				<?php
				$is_active_view_type = $view_type['type'] === $current_view_type;
				$active_view_class = $is_active_view_type ? 'mkdf-tours-search-view-item-active' : '';

				?>

				<li data-type="<?php echo esc_attr($view_type['type']); ?>" class="mkdf-tours-search-view-item <?php echo esc_attr($active_view_class); ?>">
					<a href="#">
						<span class="<?php echo esc_attr($view_type['icon']); ?>"></span>
						<span class="<?php echo esc_attr($view_type['icon']); ?>"></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>