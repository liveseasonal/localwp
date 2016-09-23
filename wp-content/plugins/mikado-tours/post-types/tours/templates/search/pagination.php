<div class="mkdf-pagination mkdf-tours-search-pagination">
		<?php if($number_of_pages > 1) : ?>
			<ul>
				<?php if($has_prev) : ?>
					<li data-page="<?php echo esc_attr($current_page - 1); ?>" class="mkdf-pagination-prev">
						<a href="http://demo.themesnoir.com/voyage300/blog-standard-date-on-side/"><span class="lnr lnr-chevron-left"></span></a>
					</li>
				<?php endif; ?>

				<?php for($i = 1; $i <= $number_of_pages; $i++) : ?>
			<?php
			$is_active    = $i === (int) $current_page;
			$active_class = $is_active ? 'active' : '';
			?>

				<li class="<?php echo esc_attr($active_class); ?>" data-page="<?php echo esc_attr($i); ?>" >
					<?php if($is_active) : ?>
						<span><?php echo esc_html($i); ?></span>
					<?php else: ?>
						<a href="#">
							<?php echo esc_html($i); ?>
						</a>
					<?php endif; ?>

					<?php endfor; ?>

					<?php if($has_next) : ?>
				<li data-page="<?php echo esc_attr($current_page + 1); ?>" class="mkdf-pagination-next">
					<a href="http://demo.themesnoir.com/voyage300/blog-standard-date-on-side/page/2/"><span class="lnr lnr-chevron-right"></span></a>
				</li>
			<?php endif; ?>
			</ul>
		<?php endif; ?>
</div>