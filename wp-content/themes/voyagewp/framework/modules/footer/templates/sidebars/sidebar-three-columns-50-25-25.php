<div class="mkdf-grid-row mkdf-footer-top-50-25-25">
	<div class="mkdf-grid-col-6">
		<?php if(is_active_sidebar('footer_column_1')) : ?>
			<?php dynamic_sidebar('footer_column_1'); ?>
		<?php endif; ?>
	</div>
	<div class="mkdf-grid-col-6">
		<div class="mkdf-grid-row">
			<div class="mkdf-grid-col-6">
				<?php if(is_active_sidebar('footer_column_2')) : ?>
					<?php dynamic_sidebar('footer_column_2'); ?>
				<?php endif; ?>
			</div>
			<div class="mkdf-grid-col-6">
				<?php if(is_active_sidebar('footer_column_3')) : ?>
					<?php dynamic_sidebar('footer_column_3'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>