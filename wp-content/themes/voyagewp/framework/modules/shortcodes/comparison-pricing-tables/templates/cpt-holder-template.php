<?php if(is_array($features) && count($features)) : ?>
	<div <?php voyage_mikado_class_attribute($holder_classes); ?>>
		<div class="mkdf-cpt-features-holder mkdf-cpt-table">
			<?php if($display_border) : ?>
				<div class="mkdf-cpt-table-border-top" <?php voyage_mikado_inline_style($border_style); ?>></div>
			<?php endif; ?>

			<div class="mkdf-cpt-features-title mkdf-cpt-table-head-holder">
				<div class="mkdf-cpt-table-head-holder-inner">
					<h4><?php echo wp_kses_post(preg_replace('#^<\/p>|<p>$#', '', $title)); ?></h4>
				</div>
			</div>
			<div class="mkdf-cpt-features-list-holder mkdf-cpt-table-content">
				<ul class="mkdf-cpt-features-list">
					<?php foreach($features as $feature) : ?>
						<li class="mkdf-cpt-features-item"><span><?php echo esc_html($feature); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php echo do_shortcode($content); ?>
	</div>
<?php endif; ?>