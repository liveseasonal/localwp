<?php

class VoyageMikadoSideAreaOpener extends VoyageMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_side_area_opener', // Base ID
			'Mikado Side Area Opener' // Name
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array(
			array(
				'name'        => 'side_area_opener_icon_color',
				'type'        => 'textfield',
				'title'       => 'Icon Color',
				'description' => 'Define color for Side Area opener icon'
			)
		);

	}


	public function widget($args, $instance) {

		$sidearea_icon_styles = array();

		if(!empty($instance['side_area_opener_icon_color'])) {
			$sidearea_icon_styles[] = 'color: '.$instance['side_area_opener_icon_color'];
		}

		print $args['before_widget'];

		$icon_size = '';
		if(voyage_mikado_options()->getOptionValue('side_area_predefined_icon_size')) {
			$icon_size = voyage_mikado_options()->getOptionValue('side_area_predefined_icon_size');
		}

		$default_sidearea_opener = voyage_mikado_options()->getOptionValue('side_area_enable_default_opener') === 'yes';

		$default_sidearea_opener_class = $default_sidearea_opener ? 'mkdf-side-menu-button-opener-default' : '';

		?>
		<a class="mkdf-side-menu-button-opener <?php echo esc_attr($icon_size.' '.$default_sidearea_opener_class); ?>" <?php voyage_mikado_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
			<?php echo voyage_mikado_get_side_menu_icon_html(); ?>
		</a>

		<?php print $args['after_widget']; ?>

	<?php }

}