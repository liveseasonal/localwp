<ul class="mkdf-membership-dashboard-nav clearfix">
	<?php
	$nav_items = mkdf_membership_get_dashboard_navigation_items();
	$action = 'profile';
	if ( isset( $_GET['user-action'] ) ) {
		$action = $_GET['user-action'];
	}
	foreach ( $nav_items as $nav_key => $nav_item ) {
		$active_class = '';
		if ($action == $nav_key){
			$active_class .= 'mkdf-active-dash';
		}
		?>
		<li class="<?php echo esc_attr($active_class);?>">
			<a href="<?php echo $nav_item['url']; ?>">
				<?php echo $nav_item['text']; ?>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Log out', 'mikado-membership' ); ?>
		</a>
	</li>
	<li class="mkdf-tab-line"></li>
</ul>