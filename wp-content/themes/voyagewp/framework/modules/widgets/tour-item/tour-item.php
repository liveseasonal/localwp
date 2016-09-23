<?php

class VoyageMikadoTourItems extends VoyageMikadoWidget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'mkdf_tour_items_widget', // Base ID
			'Mikado Tour Items', // Name
			array('description' => esc_html__('Display Tour items', 'voyage'),) // Args
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'title'   => 'Tours List Type',
				'name'    => 'tour_type',
				'options' => array(
					'standard' => 'Standard',
					'gallery'  => 'Gallery'
				),
			),
			array(
				'type'        => 'dropdown',
				'title'       => 'Order By',
				'name'        => 'order_by',
				'options'     => array(
					'menu_order' => 'Menu Order',
					'title'      => 'title',
					'date'       => 'Date'
				),
				'admin_label' => true,
				'save_always' => true,
				'description' => '',
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'title'       => 'Text length',
				'name'        => 'text_length',
				'description' => 'Number of words'
			),
			array(
				'type'    => 'dropdown',
				'title'   => 'Image Proportions',
				'name'    => 'image_size',
				'options' => array(
					'original'   => 'Original',
					'square'    => 'Square',
					'landscape' => 'Landscape',
					'portrait'  => 'Portrait',
					'custom'    => 'Custom'
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'title'       => 'Image Dimensions',
				'name'        => 'custom_image_dimensions',
				'description' => 'Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height). It will be applied only if "Custom" image proportion option is selected'
			),
			array(
				'type'        => 'dropdown',
				'title'       => 'Order',
				'name'        => 'order',
				'options'     => array(
					'ASC'  => 'ASC',
					'DESC' => 'DESC',
				),
				'admin_label' => true,
				'save_always' => true,
				'description' => '',
			),
			array(
				'type'        => 'textfield',
				'title'       => 'Tour Category',
				'name'        => 'tour_category',
				'options'     => '',
				'admin_label' => true,
				'description' => 'Enter one tour category slug (leave empty for showing all categories)',
			),
			array(
				'type'        => 'textfield',
				'title'       => 'Number of Tours Per Page',
				'name'        => 'number',
				'options'     => '-1',
				'admin_label' => true,
				'description' => '(enter -1 to show all)',
			),
			array(
				'type'        => 'textfield',
				'title'       => 'Show Only Tours with Listed IDs',
				'name'        => 'selected_tours',
				'options'     => '',
				'admin_label' => true,
				'description' => 'Delimit ID numbers by comma (leave empty for all)',
			)

		);
	}

	public function widget($args, $instance) {

		$instance['thumb_size'] = mkdf_tours_get_image_size_param($instance);
		$instance['title_style'] = '';
		$query                  = mkdf_tours_query()->buildQueryObject($instance);

		$tour_check = '';
		if(($instance['tour_type']) == 'standard') {
			$tour_check = 'standard';
		} else {
			$tour_check = 'gallery';
		}

		?>


		<div class="widget mkdf-widget-tour-holder mkdf-tours-item-with-smaller-spacing">

			<?php if($query->have_posts()) : ?>

				<?php while($query->have_posts()) : ?>
					<div class="mkdf-tours-widget-item">
						<?php $query->the_post(); ?>
						<?php echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_check, 'tours', '', '', $instance); ?>
					</div>
				<?php endwhile; ?>

			<?php endif; ?>
		</div>


		<?php


	}
}
