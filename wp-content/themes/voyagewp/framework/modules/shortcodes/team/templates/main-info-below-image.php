<?php
/**
 * Team info on hover shortcode template
 */
global $voyage_mikado_IconCollections;
$number_of_social_icons = 5;
?>

<div class="mkdf-team <?php echo esc_attr($team_type) ?>">
	<div class="mkdf-team-inner">
		<?php if($team_image !== '') { ?>
			<div class="mkdf-team-image">
				<img src="<?php print $team_image_src; ?>" alt="mkdf-team-image"/>
			</div>
		<?php } ?>

		<?php if ($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
			<div class="mkdf-team-info">
				<?php if ($team_name !== '' || $team_position !== '') { ?>
					<div class="mkdf-team-title-holder <?php echo esc_attr($team_social_icon_type) ?>">
						<?php if ($team_name !== '') { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="mkdf-team-name <?php echo esc_attr($light_class);?>">
								<?php echo esc_attr($team_name); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
						<?php } ?>
						<?php if ($team_position !== "") { ?>
							<h6 class="mkdf-team-position <?php echo esc_attr($light_class);?>"><?php echo esc_attr($team_position) ?></h6>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if ($team_description != "") { ?>
					<div class='mkdf-team-text'>
						<div class='mkdf-team-text-inner'>
							<div class='mkdf-team-description <?php echo esc_attr($light_class);?>'>
								<p><?php echo esc_attr($team_description) ?></p>
							</div>
						</div>
					</div>
				<?php }
			} ?>

		<div class="mkdf-team-social-holder-between">
			<div class="mkdf-team-social <?php echo esc_attr($team_social_icon_type) ?>">
				<div class="mkdf-team-social-inner">
					<div class="mkdf-team-social-wrapp">

						<?php foreach($team_social_icons as $team_social_icon) {
							print $team_social_icon;
						} ?>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>
</div>