<?php $cols = 4; ?>

<div class="mkdf-grid-row mkdf-footer-top-four-cols">
	<?php for($i = 1; $i <= $cols; $i++) : ?>
		<div class="mkdf-grid-col-3 mkdf-grid-col-ipad-portrait-12">
			<?php if(is_active_sidebar('footer_column_'.$i)) :
				dynamic_sidebar('footer_column_'.$i);
			endif; ?>
		</div>
	<?php endfor; ?>
</div>