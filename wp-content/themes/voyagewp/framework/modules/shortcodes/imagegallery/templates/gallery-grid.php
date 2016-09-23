<div class="mkdf-image-gallery">
    <div class="mkdf-image-gallery-grid <?php echo esc_html($columns); ?><?php echo esc_attr($space); ?> <?php echo esc_html($gallery_classes); ?>">
        <?php foreach($images as $image) { ?>
            <div class="mkdf-gallery-image">
                <div class="mkdf-hover-holder">
                	<?php if ($hover_click_action == 'title_link'){ ?>
                    <div class="mkdf-image-gallery-hover">
						<div class="mkdf-image-gallery-hover-table">
							<div class="mkdf-image-gallery-hover-cell">
								<?php if ($image['title'] !== ''){ ?>
								<span class="mkdf-image-gallery-title"><?php echo esc_html($image['title']);?></span>
								<?php }
								if ($image['image_link'] !== '' && $image['image_link_text'] !== ''){ ?>
									<a class="mkdf-gallery-link" href="<?php echo esc_url($image['image_link']);?>" target="_blank"><?php echo esc_html($image['image_link_text']);?></a>
								<?php }	?>
							</div>
						</div>
                    </div>
                    <?php } ?>

                    <?php if ($hover_click_action == 'pretty_photo'){ ?>
                    	<a class="mkdf-gallery-prettyphoto" href="<?php echo esc_url($image['url']) ?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
                    <?php } ?>
                        <?php if(is_array($image_size) && count($image_size)) : ?>
                            <?php echo voyage_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
                        <?php endif; ?>
					<?php if($hover_click_action == 'pretty_photo') { ?>
                    		<div class="mkdf-icon-holder"><?php echo voyage_mikado_icon_collections()->renderIcon('icon_plus', 'font_elegant'); ?></div>
						</a>
					<?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>