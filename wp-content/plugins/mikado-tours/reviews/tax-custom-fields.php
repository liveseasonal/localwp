<?php

function mkdf_tour_review_criteria_edit_taxonomy_custom_fields($tag) {
	$t_id      = $tag->term_id; // Get the ID of the term you're editing
	$term_meta = get_option("taxonomy_term_$t_id");
	?>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="criteria_order"><?php _e('Order', 'mikado-tours'); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[criteria_order]" id="term_meta[criteria_order]" style="width: 100px;" value="<?php if(isset($term_meta['criteria_order']) && $term_meta['criteria_order'] != '') { echo esc_attr($term_meta['criteria_order']); } ?>">
			<p class="description"><?php _e('If there are multiple criteria, they will be displayed in an ascending order.', 'mikado-tours'); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="main_criterion"><?php _e('Show in Reviews?', 'mikado-tours'); ?></label>
		</th>
		<td>
			<select name="term_meta[main_criterion]" id="term_meta[main_criterion]">
				<option <?php if(isset($term_meta['main_criterion']) && $term_meta['main_criterion'] == 'no') {
					echo "selected='selected'";
				} ?> value="no">No
				</option>
				<option <?php if(isset($term_meta['main_criterion']) && $term_meta['main_criterion'] == 'yes') {
					echo "selected='selected'";
				} ?> value="yes">Yes
				</option>
			</select>
			<p class="description"><?php _e('All the criteria can be rated when leaving a review, but only those marked to be shown will be displayed in the list of reviews.', 'mikado-tours'); ?></p>
		</td>
	</tr>

	<?php
}

function mkdf_tour_review_criteria_save_taxonomy_custom_fields($term_id) {
	if(isset($_POST['term_meta'])) {
		$t_id      = $term_id;
		$term_meta = get_option("taxonomy_term_$t_id");
		$cat_keys  = array_keys($_POST['term_meta']);
		foreach($cat_keys as $key) {
			if(isset($_POST['term_meta'][$key])) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		update_option("taxonomy_term_$t_id", $term_meta);
	}
}

add_action('review-criteria_edit_form_fields', 'mkdf_tour_review_criteria_edit_taxonomy_custom_fields', 10, 2);
add_action('edited_review-criteria', 'mkdf_tour_review_criteria_save_taxonomy_custom_fields', 10, 2);


add_filter("manage_edit-review-criteria_columns", 'mkdf_tour_review_criteria_columns');
function mkdf_tour_review_criteria_columns($columns) {
	$new_columns = array(
		'cb'        => '<input type="checkbox" />',
		'name'      => __('Name', 'mikado-tours'),
		'slug'      => __('Slug', 'mikado-tours'),
		'criteria_order'      => __('Order', 'mikado-tours'),
		'main_criterion' => __('Shown in Reviews', 'mikado-tours'),
	);

	return $new_columns;
}

add_filter("manage_review-criteria_custom_column", 'mkdf_tour_review_criteria_column_values', 10, 3);
function mkdf_tour_review_criteria_column_values($out, $column_name, $theme_id) {
	$theme = get_term($theme_id, 'review-criteria');
	$term_meta = get_option("taxonomy_term_".$theme->term_id);
	switch($column_name) {
		case 'criteria_order':
			$out .= isset($term_meta['criteria_order']) ? $term_meta['criteria_order'] : '-';
			break;
		case 'main_criterion':
			$out .= (isset($term_meta['main_criterion']) && $term_meta['main_criterion'] == 'yes') ? 'Yes' : 'No';
			break;

		default:
			break;
	}

	return $out;
}


?>