<?php do_action('voyage_mikado_before_mobile_navigation'); ?>

	<nav class="mkdf-mobile-nav">
		<div class="mkdf-grid">
			<?php wp_nav_menu(array(
				'theme_location'  => 'main-navigation',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'fallback_cb'     => 'top_navigation_fallback',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'walker'          => new VoyageMikadoMobileNavigationWalker()
			)); ?>
		</div>
	</nav>

<?php do_action('voyage_mikado_after_mobile_navigation'); ?>