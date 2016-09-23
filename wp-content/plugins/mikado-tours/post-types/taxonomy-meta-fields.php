<?php
/**
 * Tour item category add taxonomy meta fields
 */

if(!function_exists('mkdf_tours_add_taxonomy_meta_fields')) {

	/**
	 *
	 */
	function mkdf_tours_add_taxonomy_meta_fields() { ?>

		<div class="form-field term-icons-wrap">
			<label for="term-icons"><?php esc_html_e('Icon', 'mikado-tours'); ?></label>
			<?php if(function_exists('voyage_mikado_icon_collections')) {
				$icon_collections = voyage_mikado_icon_collections()->getIconCollections();
				$collections      = array();
				foreach($icon_collections as $ic_key => $ic_name) {
					$collections[] = voyage_mikado_icon_collections()->getIconCollection($ic_key);
				}
			} else {
				$icon_collections = array();
				$collections      = array();
			} ?>
			<div>
				<label for="icon_pack">Icon Pack</label>
				<select name="icon_pack" id="icon_pack">
					<?php
					foreach($icon_collections as $key => $value) { ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				</select>
			</div>
			<?php
			foreach($collections as $col) { ?>
				<div class="icon-collection <?php echo str_replace(' ', '_', strtolower($col->title)); ?>"
					style="display: none">
					<label for="<?php echo $col->param; ?>"><?php echo $col->title; ?></label>
					<select name="<?php echo $col->param; ?>" id="<?php echo $col->param; ?>">
						<?php
						$icons = voyage_mikado_icon_collections()->getIconCollectionIcons($col);
						foreach($icons as $key => $value) { ?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>
		</div>

		<div class="form-field term-custom-image-wrap">
			<label for="term-custom-image"><?php esc_html_e('Custom Image', 'mikado-tours'); ?></label>
			<div>
				<input id="term-custom-image" type="text" name="term_custom_image" value="">
			</div>
		</div>

	<?php }

	add_action('tour-category_add_form_fields', 'mkdf_tours_add_taxonomy_meta_fields', 10, 2);

}

if(!function_exists('mkdf_tours_save_taxonomy_meta_fields')) {

	/**
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function mkdf_tours_save_taxonomy_meta_fields($term_id, $taxonomy_id) {
		if(isset($_POST)) {

			$icon_pack          = $_POST['icon_pack'];
			$fa_icon            = $_POST['fa_icon'];
			$fe_icon            = $_POST['fe_icon'];
			$ion_icon           = $_POST['ion_icon'];
			$linea_icon         = $_POST['linea_icon'];
			$simple_line_icons  = $_POST['simple_line_icons'];
			$dripicon           = $_POST['dripicon'];
			$linear_icons       = $_POST['linear_icon'];
			$custom_image       = $_POST['term_custom_image'];
			$light_custom_image = $_POST['light_term_custom_image'];

			add_term_meta($term_id, 'icon_pack', $icon_pack, true);
			add_term_meta($term_id, 'fa_icon', $fa_icon, true);
			add_term_meta($term_id, 'fe_icon', $fe_icon, true);
			add_term_meta($term_id, 'ion_icon', $ion_icon, true);
			add_term_meta($term_id, 'linea_icon', $linea_icon, true);
			add_term_meta($term_id, 'simple_line_icons', $simple_line_icons, true);
			add_term_meta($term_id, 'dripicon', $dripicon, true);
			add_term_meta($term_id, 'linear_icon', $linear_icons, true);
			add_term_meta($term_id, 'term_custom_image', $custom_image, true);
			add_term_meta($term_id, 'light_term_custom_image', $light_custom_image, true);
		}
	}

	add_action('created_tour-category', 'mkdf_tours_save_taxonomy_meta_fields', 10, 2);
}

if(!function_exists('mkdf_tours_edit_taxonomy_meta_fields')) {

	/**
	 * @param $term
	 * @param $taxonomy
	 */
	function mkdf_tours_edit_taxonomy_meta_fields($term, $taxonomy) {

		$icon_pack               = get_term_meta($term->term_id, 'icon_pack', true);
		$term_custom_image       = get_term_meta($term->term_id, 'term_custom_image', true);
		$light_term_custom_image = get_term_meta($term->term_id, 'light_term_custom_image', true);

		?>
		<tr class="form-field term-icons-wrap">
			<th scope="row"><label for="term-icons"><?php esc_html_e('Icon', 'mikado-tours'); ?></label></th>
			<td>
				<?php if(function_exists('voyage_mikado_icon_collections')) {
					$icon_collections = voyage_mikado_icon_collections()->getIconCollections();
					$collections      = array();
					foreach($icon_collections as $ic_key => $ic_name) {
						$collections[] = voyage_mikado_icon_collections()->getIconCollection($ic_key);
					}
				} else {
					$icon_collections = array();
					$collections      = array();
				} ?>
				<div>
					<label for="icon_pack">Icon Pack</label>
					<select name="icon_pack" id="icon_pack">
						<?php
						foreach($icon_collections as $key => $value) { ?>
							<option value="<?php echo $key; ?>" <?php if($key == $icon_pack) {
								echo 'selected';
							} ?>><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
				<?php foreach($collections as $col) { ?>
					<div class="icon-collection <?php echo str_replace(' ', '_', strtolower($col->title)); ?>"
						style="display: none">
						<label for="<?php echo $col->param; ?>"><?php echo $col->title; ?></label>
						<select name="<?php echo $col->param; ?>" id="<?php echo $col->param; ?>">
							<?php
							$selected_icon = get_term_meta($term->term_id, $col->param, true);
							$icons         = voyage_mikado_icon_collections()->getIconCollectionIcons($col);
							foreach($icons as $key => $value) { ?>
								<option value="<?php echo $key; ?>" <?php if($key == $selected_icon) {
									echo 'selected';
								} ?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
					</div>
				<?php } ?>
			</td>
		</tr>

		<tr class="form-field term-image-wrap">
			<th scope="row"><label for="term-custom-image"><?php esc_html_e('Custom Image', 'mikado-tours'); ?></label>
			</th>
			<td>
				<input id="term-custom-image" type="text" name="term_custom_image" value="<?php echo esc_attr($term_custom_image); ?>">
			</td>
		</tr>

		<tr class="form-field term-image-wrap">
			<th scope="row">
				<label for="light-term-custom-image"><?php esc_html_e('Light Custom Image', 'mikado-tours'); ?></label>
			</th>
			<td>
				<input id="light-term-custom-image" type="text" name="light_term_custom_image" value="<?php echo esc_attr($light_term_custom_image); ?>">
			</td>
		</tr>

	<?php }

	add_action('tour-category_edit_form_fields', 'mkdf_tours_edit_taxonomy_meta_fields', 11, 2);
}

if(!function_exists('mkdf_tours_update_taxonomy_meta_fields')) {
	/**
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function mkdf_tours_update_taxonomy_meta_fields($term_id, $taxonomy_id) {

		if(isset($_POST)) {

			$icon_pack          = $_POST['icon_pack'];
			$fa_icon            = $_POST['fa_icon'];
			$fe_icon            = $_POST['fe_icon'];
			$ion_icon           = $_POST['ion_icon'];
			$linea_icon         = $_POST['linea_icon'];
			$simple_line_icons  = $_POST['simple_line_icons'];
			$dripicon           = $_POST['dripicon'];
			$linear_icons       = $_POST['linear_icon'];
			$custom_image       = $_POST['term_custom_image'];
			$light_custom_image = $_POST['light_term_custom_image'];

			update_term_meta($term_id, 'icon_pack', $icon_pack);
			update_term_meta($term_id, 'fa_icon', $fa_icon);
			update_term_meta($term_id, 'fe_icon', $fe_icon);
			update_term_meta($term_id, 'ion_icon', $ion_icon);
			update_term_meta($term_id, 'linea_icon', $linea_icon);
			update_term_meta($term_id, 'simple_line_icons', $simple_line_icons);
			update_term_meta($term_id, 'dripicon', $dripicon);
			update_term_meta($term_id, 'linear_icon', $linear_icons);
			update_term_meta($term_id, 'term_custom_image', $custom_image);
			update_term_meta($term_id, 'light_term_custom_image', $light_custom_image);
		}
	}

	add_action('edited_tour-category', 'mkdf_tours_update_taxonomy_meta_fields', 10, 2);
}