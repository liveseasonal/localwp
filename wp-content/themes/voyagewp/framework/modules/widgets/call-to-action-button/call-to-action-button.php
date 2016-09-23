<?php

class VoyageMikadoCallToActionButton extends VoyageMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_call_to_action_button', // Base ID
			'Mikado Call To Action Button' // Name
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array_merge(
			voyage_mikado_icon_collections()->getWidgetIconParams(),
			array(
				array(
					'type'        => 'textfield',
					'title'       => 'Button Text',
					'name'        => 'button_text',
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'title'       => 'Link',
					'name'        => 'link',
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'title'       => 'Link Target',
					'name'        => 'link_target',
					'options'     => array(
						'_self'  => 'Same Window',
						'_blank' => 'New Window'
					),
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'title'       => 'Text Color',
					'name'        => 'text_color',
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'title'       => 'Background Color',
					'name'        => 'background_color',
					'description' => ''
				)
			)
		);

	}

	public function widget($args, $instance) {
		print $args['before_widget'];

		$iconPack = $instance['icon_pack'];
		$iconHtml = '';

		if($iconPack !== '') {
			$iconPackName = voyage_mikado_icon_collections()->getIconCollectionParamNameByKey($iconPack);
			$icon         = $instance[$iconPackName];

			$iconHtml = voyage_mikado_icon_collections()->renderIcon($icon, $iconPack);
		}

		$buttonStyles = array();

		if($instance['background_color'] !== '') {
			$buttonStyles[] = 'background-color: '.$instance['background_color'];
		}

		if($instance['text_color'] !== '') {
			$buttonStyles[] = 'color: '.$instance['text_color'];
		}

		?>

		<?php if($instance['link'] !== '' && $instance['button_text'] !== '') : ?>
			<a <?php voyage_mikado_inline_style($buttonStyles); ?> class="mkdf-call-to-action-button" target="<?php echo esc_attr($instance['link_target']); ?>" href="<?php echo esc_url($instance['link']) ?>">
				<span class="mkdf-ctab-holder">
					<?php if($iconHtml !== '') : ?>
						<span class="mkdf-ctab-icon">
							<?php print $iconHtml; ?>
						</span>
					<?php endif; ?>
					<?php echo esc_html($instance['button_text']); ?>
				</span>
			</a>
		<?php endif; ?>

		<?php print $args['after_widget'];
	}
}