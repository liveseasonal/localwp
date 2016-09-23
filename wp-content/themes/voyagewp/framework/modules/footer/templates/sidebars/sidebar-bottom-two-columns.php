<div class="mkdf-grid-row mkdf-footer-bottom-two-cols">
	<div class="mkdf-grid-col-6">
		<?php if(is_active_sidebar('footer_bottom_left')) :
			dynamic_sidebar('footer_bottom_left');
		endif; ?>
	</div>
	<div class="mkdf-grid-col-6">
		<?php if(is_active_sidebar('footer_bottom_right')) :
			dynamic_sidebar('footer_bottom_right');
		endif; ?>
	</div>
</div>