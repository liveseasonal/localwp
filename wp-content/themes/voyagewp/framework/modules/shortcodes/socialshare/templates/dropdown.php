<div class="mkdf-social-share-holder mkdf-dropdown">
	<a href="javascript:void(0)" target="_self" class="mkdf-social-share-dropdown-opener">
		<i class="social_share"></i>
		<span class="mkdf-social-share-title"><?php esc_html_e('Share', 'voyage') ?></span>
	</a>

	<div class="mkdf-social-share-dropdown">
		<ul>
			<?php foreach($networks as $net) {
				print $net;
			} ?>
		</ul>
	</div>
</div>