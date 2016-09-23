<?php if(!empty($video_link)) : ?>
	<div class="mkdf-video-banner-holder">
		<a class="mkdf-video-banner-link" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[<?php echo esc_attr($banner_id); ?>]">
			<?php if(!empty($video_banner)) : ?>
				<?php echo wp_get_attachment_image($video_banner, 'full'); ?>
			<?php endif; ?>
			<div class="mkdf-video-banner-overlay">
				<div class="mkdf-vb-overlay-tb">
					<div class="mkdf-vb-overlay-tc">
						<?php echo voyage_mikado_icon_collections()->renderIcon('arrow_triangle-right_alt2', 'font_elegant', array('icon_attributes' => array('class' => 'mkdf-vb-play-icon'))); ?>
					</div>
				</div>
			</div>
		</a>
	</div>
<?php endif; ?>