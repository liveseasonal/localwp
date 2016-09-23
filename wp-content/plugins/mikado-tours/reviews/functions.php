<?php

if(!function_exists('mkdf_tours_reviews_get_criteria')) {
	function mkdf_tours_reviews_get_criteria($main_only = false) {
		/*
			Get the necessary data about user-defined review criteria 
			PAY ATTENTION: The taxonomy slug being used is 'review-criteria'
		*/
		global $wpdb;
		$review_criteria = $wpdb->get_results("SELECT {$wpdb->prefix}terms.term_id AS id, {$wpdb->prefix}terms.slug AS slug, {$wpdb->prefix}terms.name AS name FROM {$wpdb->prefix}terms LEFT JOIN {$wpdb->prefix}term_taxonomy ON {$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id WHERE {$wpdb->prefix}term_taxonomy.taxonomy = 'review-criteria'");

		$final_criteria = array();
		foreach($review_criteria as $review_criterion) {
			$temp_criterion          = (array) $review_criterion;
			$term_meta               = get_option("taxonomy_term_".$temp_criterion['id']);
			$temp_criterion['main']  = (isset($term_meta['main_criterion']) && $term_meta['main_criterion'] == 'yes') ? true : false;
			$temp_criterion['order'] = isset($term_meta['criteria_order']) ? (int) $term_meta['criteria_order'] : PHP_INT_MAX;
			$add_criterion           = true;
			if($main_only && !$temp_criterion['main']) {
				$add_criterion = false;
			}
			if($add_criterion) {
				$final_criteria[] = (object) $temp_criterion;
			}
		}
		for($i = 0; $i < count($final_criteria) - 1; $i++) {
			for($j = $i + 1; $j < count($final_criteria); $j++) {
				if($final_criteria[$i]->order > $final_criteria[$j]->order) {
					$temp               = $final_criteria[$i];
					$final_criteria[$i] = $final_criteria[$j];
					$final_criteria[$j] = $temp;
				}
			}
		}

		return $final_criteria;
	}
}

if(!function_exists('mkdf_tours_reviews_rating_allowed')) {
	function mkdf_tours_reviews_rating_allowed($post_id = null) {
		// As this function is called by mkdf_tours_reviews_echo_form_part(), which hooks to comment_form_logged_in_after action, the user is already logged in
		global $wpdb;
		$post_id = empty($post_id) ? get_the_ID() : $post_id;
		$user    = wp_get_current_user();

		$query = "SELECT COUNT({$wpdb->prefix}review_ratings.rating) AS ratings FROM {$wpdb->prefix}comments LEFT JOIN {$wpdb->prefix}review_ratings ON {$wpdb->prefix}comments.comment_ID = {$wpdb->prefix}review_ratings.comment_id WHERE {$wpdb->prefix}comments.comment_post_ID = %d AND {$wpdb->prefix}comments.comment_author = %s";


		$results = $wpdb->get_results(
			$wpdb->prepare($query, $post_id, $user->user_login)
		);

		if(count($results) && $results[0]->ratings > 0) {
			return false;
		} else {
			return true;
		}
	}
}

if(!function_exists('mkdf_tours_reviews_echo_form_part')) {
	function mkdf_tours_reviews_echo_form_part() {
		if(get_post_type() == 'tour-item' && mkdf_tours_reviews_rating_allowed()) {
			?>

			<div class="mkdf-tour-reviews-input-wrapper">
				<div class="mkdf-tour-reviews-input clearfix">
					<?php
					$review_criteria = mkdf_tours_reviews_get_criteria();

					if(is_array($review_criteria) && count($review_criteria)) {
						?>
						<input type="hidden" name="mkdf_reviews_comment_type" value="review">
						<?php foreach($review_criteria as $review_criterion) {
							?>
							<div class="mkdf-tour-reviews-criteria-holder">
								<div class="mkdf-tour-reviews-criteria-holder-inner">
									<span class="mkdf-tour-reviews-criterion-name"><?php echo esc_html($review_criterion->name); ?></span>
								<span class="mkdf-tour-reviews-rating-holder">
								<?php
								for($i = 0; $i < MIKADO_TOURS_REVIEWS_MAX_RATING; $i++) {
									?>
									<span class="mkdf-tour-reviews-star-holder"><span class="mkdf-tour-reviews-star icon_star_alt"></span></span>
									<?php
								}
								?>
								</span>
									<input type="text" class="mkdf-tour-reviews-hidden-input" name="<?php echo esc_attr(MIKADO_TOURS_REVIEWS_PREFIX.$review_criterion->slug); ?>" value="">
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>

			<?php
		}
	}

	add_action('comment_form_top', 'mkdf_tours_reviews_echo_form_part');
}

if(!function_exists('mkdf_tours_reviews_criteria_check')) {
	function mkdf_tours_reviews_criteria_check() {
		/*
			Check if all rating criteria is completed properly
		*/
		global $wpdb;

		$allowed_values   = range(1, MIKADO_TOURS_REVIEWS_MAX_RATING); // system n out of MIKADO_TOURS_REVIEWS_MAX_RATING stars
		$missing_criteria = '';
		$review_criteria  = mkdf_tours_reviews_get_criteria();

		if(isset($_POST['mkdf_reviews_comment_type']) && $_POST['mkdf_reviews_comment_type'] === 'review') {
			foreach($review_criteria as $review_criterion) {
				if(!in_array((int) $_POST[MIKADO_TOURS_REVIEWS_PREFIX.$review_criterion->slug], $allowed_values)) {
					$missing_criteria .= (strlen($missing_criteria) ? ', ' : '').$review_criterion->name;
				}
			}
			if(strlen($missing_criteria)) {
				// Prevent comment from being saved and die immediately.
				wp_die(__('You must rate the following before submitting the comment:', 'mikado-tours').' '.$missing_criteria.'. '.__('Please try again.', 'mikado-tours'));
			}
		}
	}

	add_action('pre_comment_on_post', 'mkdf_tours_reviews_criteria_check');
}

if(!function_exists('mkdf_tours_reviews_save_ratings')) {
	function mkdf_tours_reviews_save_ratings($comment_id) {
		global $wpdb;

		if(isset($_POST['mkdf_reviews_comment_type']) && $_POST['mkdf_reviews_comment_type'] === 'review') {
			$review_criteria = mkdf_tours_reviews_get_criteria();
			foreach($review_criteria as $review_criterion) {
				$criteria_id = $review_criterion->id;
				$rating      = $_POST[MIKADO_TOURS_REVIEWS_PREFIX.$review_criterion->slug];
				$result      = $wpdb->insert(
					$wpdb->prefix.'review_ratings',
					array(
						'comment_id'  => $comment_id,
						'criteria_id' => $criteria_id,
						'rating'      => $rating
					),
					array(
						'%d',
						'%d',
						'%d'
					)
				);
				if(!$result) {
					// If there has been an error with saving ratings, delete the review (comment) as well
					$wpdb->delete($wpdb->prefix.'comments', array('comment_ID' => $comment_id));
					wp_die(__('There has been an error in saving your review. Please try again.', 'mikado-tours'));
				}
			}
		}
	}

	add_action('comment_post', 'mkdf_tours_reviews_save_ratings');
}

if(!function_exists('mkdf_tours_reviews_adjust_form_fields')) {
	function mkdf_tours_reviews_adjust_form_fields($args) {

		if(get_post_type() == 'tour-item') {
			$args['title_reply']       = esc_html__('Write a Review', 'mikado-tours');
			$args['title_reply_to']    = esc_html__('Post a Review to %s', 'mikado-tours');
			$args['cancel_reply_link'] = esc_html__('Cancel Review', 'mikado-tours');
			$args['comment_field']     = '<textarea id="comment" placeholder="'.esc_html__('Review text', 'mikado-tours').'" name="comment" cols="45" rows="8" aria-required="true"></textarea>';

			$commenter = wp_get_current_commenter();
			$req       = get_option('require_name_email');
			$aria_req  = ($req ? " aria-required='true'" : '');

			$author_field = '<div class="mkdf-grid-row">';
			$author_field .= '<div class="mkdf-grid-col-6">';
			$author_field .= '<input id="author" name="author" placeholder="'.esc_html__('Your full name', 'mikado-tours').'" type="text" value="'.esc_attr($commenter['comment_author']).'"'.$aria_req.' />';
			$author_field .= '</div>';

			$email_field = '<div class="mkdf-grid-col-6">';
			$email_field .= '<input id="email" name="email" placeholder="'.esc_html__('E-mail address', 'mikado-tours').'" type="text" value="'.esc_attr($commenter['comment_author_email']).'"'.$aria_req.' />';
			$email_field .= '</div>';
			$email_field .= '</div>';

			$args['fields'] = array(
				'author' => $author_field,
				'email'  => $email_field
			);
		}

		return $args;
	}

	add_filter('voyage_mikado_comment_form_final_fields', 'mkdf_tours_reviews_adjust_form_fields');
}

if(!function_exists('mkdf_tours_reviews_format_rating_output')) {
	function mkdf_tours_reviews_format_rating_output($rating) {
		return floor($rating * MIKADO_TOURS_REVIEWS_POINTS_SCALE).'.'.round($rating * MIKADO_TOURS_REVIEWS_POINTS_SCALE * 10) % 10;
	}
}

if(!function_exists('mkdf_tours_get_criteria_ratings')) {
	function mkdf_tours_get_criteria_ratings($post_id) {
		global $wpdb;

		$review_criteria     = mkdf_tours_reviews_get_criteria();
		$criteria_data_array = array();
		$querried_criteria   = array();
		foreach($review_criteria as $review_criterion) {
			$criteria_data_array[$review_criterion->id] = array(
				'slug'   => $review_criterion->slug,
				'name'   => $review_criterion->name,
				'main'   => $review_criterion->main,
				'order'  => $review_criterion->order,
				'rating' => 0,
				'count'  => 0
			);

			$querried_criteria[] = $review_criterion->id;
		}

		array_unshift($querried_criteria, $post_id);
		$ratings_sql = "SELECT {$wpdb->prefix}review_ratings.criteria_id AS criteria_id, COUNT({$wpdb->prefix}review_ratings.rating) AS count, AVG({$wpdb->prefix}review_ratings.rating) AS rating 
						FROM {$wpdb->prefix}comments LEFT JOIN {$wpdb->prefix}review_ratings ON {$wpdb->prefix}comments.comment_ID = {$wpdb->prefix}review_ratings.comment_id 
						WHERE {$wpdb->prefix}comments.comment_post_ID = %d AND {$wpdb->prefix}comments.comment_approved=1";

		if(count($review_criteria)) {
			$querried_criteria_placeholder = implode(',', array_fill(0, count($review_criteria), '%d'));
			$ratings_sql .= " AND {$wpdb->prefix}review_ratings.criteria_id IN ( {$querried_criteria_placeholder} )";
		}

		$ratings_sql .= " GROUP BY {$wpdb->prefix}review_ratings.criteria_id";
		$rating_rows = $wpdb->get_results($wpdb->prepare($ratings_sql, $querried_criteria));

		if(is_array($rating_rows) && count($rating_rows)) {
			foreach($rating_rows as $rating_row) {
				if(isset($criteria_data_array[$rating_row->criteria_id])) {
					$criteria_data_array[$rating_row->criteria_id]['count']  = (int) $rating_row->count;
					$criteria_data_array[$rating_row->criteria_id]['rating'] = floatval($rating_row->rating);
				}
			}
		}

		return $criteria_data_array;
	}
}

if(!function_exists('mkdf_tours_reviews_print_ratings_display')) {
	function mkdf_tours_reviews_print_ratings_display() {
		$criteria_data_array = mkdf_tours_get_criteria_ratings(get_the_ID());
		$title               = mkdf_tours_theme_installed() ? voyage_mikado_options()->getOptionValue('reviews_section_title') : '';
		$subtitle            = mkdf_tours_theme_installed() ? voyage_mikado_options()->getOptionValue('reviews_section_subtitle') : '';

		if(is_array($criteria_data_array) && count($criteria_data_array)) {
			$average_rating = mkdf_tours_reviews_get_total_average($criteria_data_array);
			?>

			<?php if($average_rating) : ?>
				<div class="mkdf-tour-reviews-display-wrapper clearfix">
				<?php if($title) : ?>
					<?php echo voyage_mikado_execute_shortcode('mkdf_section_title', array(
						'title'      => $title,
						'title_size' => 'medium'
					)); ?>
				<?php endif; ?>

				<?php if($subtitle) : ?>
					<?php echo voyage_mikado_execute_shortcode('mkdf_section_subtitle', array(
						'text'      => $subtitle
					)); ?>
				<?php endif; ?>

				<div class="mkdf-tours-reviews-breakdown">
					<div class="mkdf-tour-reviews-display-left">
						<div class="mkdf-tour-reviews-display-left-inner">
							<div class="mkdf-tour-reviews-average-wrapper">
								<div class="mkdf-tour-reviews-average-rating"><?php echo esc_html(mkdf_tours_reviews_format_rating_output($average_rating)); ?></div>
								<div class="mkdf-tour-reviews-verbal-description">
									<span class="mkdf-tour-reviews-rating-icon"><?php echo mkdf_tours_reviews_get_icon_for_rating($average_rating); ?></span>
									<span class="mkdf-tour-reviews-rating-description"><?php echo esc_html(mkdf_tours_reviews_get_description_for_rating($average_rating)); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="mkdf-tour-reviews-display-right">
						<div class="mkdf-tours-reviews-display-right-inner">
							<?php
							foreach($criteria_data_array as $criteria_id => $data) {
								if($data['count']) {
									?>
									<div class="mkdf-tour-reviews-display-bar">
										<div class="mkdf-tour-reviews-display-bar-inner">
											<div class="mkdf-tour-reviews-bar-holder">
												<div class="mkdf-tour-reviews-bar-progress" style="width: <?php echo esc_attr($data['rating'] / MIKADO_TOURS_REVIEWS_MAX_RATING * 100); ?>%;">
													<div class="mkdf-tour-reviews-bar-rating"><?php echo esc_html(mkdf_tours_reviews_format_rating_output($data['rating'])); ?></div>
												</div>
												<div class="mkdf-tour-reviews-bar-title"><?php echo esc_html($data['name']); ?></div>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>

			</div>

			<?php endif; ?>
			<?php
		}
	}
}

if(!function_exists('mkdf_tours_reviews_get_total_average')) {
	function mkdf_tours_reviews_get_total_average($criteria_data_array) {
		/**
		 *
		 * Expected input is an array with keys representing review criteria id, and values being arrays containing key 'rating' for given criteria
		 */
		$sum = 0;

		if(is_array($criteria_data_array) && count($criteria_data_array)) {
			foreach($criteria_data_array as $criteria_id => $data) {
				$sum += floatval($data['rating']);
			}

			return $sum / count($criteria_data_array);
		}

		return $sum;
	}
}

if(!function_exists('mkdf_tours_reviews_get_icon_list')) {
	function mkdf_tours_reviews_get_icon_list() {
		return array(
			'<span class="lnr lnr-sad"></span>',
			'<span class="lnr lnr-neutral"></span>',
			'<span class="lnr lnr-smile"></span>'
		);
	}
}

if(!function_exists('mkdf_tours_reviews_get_icon_for_rating')) {
	function mkdf_tours_reviews_get_icon_for_rating($rating) {
		if(!$rating) {
			return '';
		}

		$icons = mkdf_tours_reviews_get_icon_list();
		$delta = MIKADO_TOURS_REVIEWS_MAX_RATING / count($icons);

		return $icons[ceil($rating / $delta) - 1];
	}
}

if(!function_exists('mkdf_tours_reviews_get_description_list')) {
	function mkdf_tours_reviews_get_description_list() {
		return array(
			esc_html__('Poor', 'mikado-tours'),
			esc_html__('Good', 'mikado-tours'),
			esc_html__('Superb', 'mikado-tours')
		);
	}
}

if(!function_exists('mkdf_tours_reviews_get_description_for_rating')) {
	function mkdf_tours_reviews_get_description_for_rating($rating) {
		if(!$rating) {
			return '';
		}

		$terms = mkdf_tours_reviews_get_description_list();
		$delta = MIKADO_TOURS_REVIEWS_MAX_RATING / count($terms);

		return $terms[ceil($rating / $delta) - 1];
	}
}

if(!function_exists('mkdf_tours_reviews_print_comment_template')) {
	function mkdf_tours_reviews_print_comment_template($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;
		global $wpdb;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment   = $post->post_author == $comment->user_id;

		$comment_class = 'mkdf-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' mkdf-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' mkdf-pingback-comment';
		}

		$review_criteria     = mkdf_tours_reviews_get_criteria(true);
		$criteria_data_array = array();
		$querried_criteria   = array();
		foreach($review_criteria as $review_criterion) {
			$criteria_data_array[$review_criterion->id] = array(
				'slug'   => $review_criterion->slug,
				'name'   => $review_criterion->name,
				'rating' => 0
			);
			$querried_criteria[]                        = $review_criterion->id;
		}
		if (is_array($review_criteria) && count($review_criteria)){
			$querried_criteria_placeholder = implode(',', array_fill(0, count($review_criteria), '%d'));
			array_unshift($querried_criteria, $comment->comment_ID);
		
			$rating_rows = $wpdb->get_results($wpdb->prepare("SELECT criteria_id, rating FROM {$wpdb->prefix}review_ratings WHERE comment_id = %d AND criteria_id IN ( {$querried_criteria_placeholder} )", $querried_criteria));

			foreach($rating_rows as $rating_row) {
				if(isset($criteria_data_array[$rating_row->criteria_id])) {
					$criteria_data_array[$rating_row->criteria_id]['rating'] = (int) $rating_row->rating;
				}
			}
		}

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="mkdf-comment-image"> <?php echo get_avatar($comment, 75); ?> </div>
			<?php } ?>
			<div class="mkdf-comment-text">
				<div class="mkdf-comment-info">
					<h5 class="mkdf-comment-name">
						<?php if($is_pingback_comment) {
							esc_html_e('Pingback:', 'mikado-tours');
						} ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
					</h5>
					<div class="mkdf-comment-date"><?php comment_time(get_option('date_format')); ?><?php esc_html_e(' at ', 'mikado-tours'); ?><?php comment_time(get_option('time_format')); ?></div>
				</div>

				<?php if(!$is_pingback_comment) { ?>
					<div class="mkdf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>

				<div class="mkdf-review-ratings">
					<?php
					foreach($criteria_data_array as $criteria_id => $data) {
						if($data['rating']) {
							?>
							<div class="mkdf-tour-reviews-criteria-holder">
								<div class="mkdf-tour-reviews-criteria-holder-inner">
									<span class="mkdf-tour-reviews-criterion-name"><?php echo esc_html($data['name']); ?></span>
								<span class="mkdf-tour-reviews-rating-holder">
								<?php
								for($i = 0; $i < MIKADO_TOURS_REVIEWS_MAX_RATING; $i++) {
									?>
									<span class="mkdf-tour-reviews-star-holder"><span class="mkdf-tour-reviews-star icon_star<?php if($i >= $data['rating']) {
											echo '_alt';
										} ?>"></span></span>
									<?php
								}
								?>
								</span>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}
}

//$comment, $args, $depth

if(!function_exists('mkdf_tours_reviews_change_comment_template')) {
	function mkdf_tours_reviews_change_comment_template($args) {

		if(get_post_type() == 'tour-item') {
			$args['callback'] = 'mkdf_tours_reviews_print_comment_template';
		}

		return $args;
	}

	add_filter('wp_list_comments_args', 'mkdf_tours_reviews_change_comment_template');
}

if(!function_exists('mkdf_tours_reviews_print_review_template')) {
	function mkdf_tours_reviews_print_review_template() {
		mkdf_tours_reviews_print_ratings_display();

		remove_action('voyage_mikado_comments_title', 'voyage_mikado_comments_title');
		comments_template('', true);
	}
}