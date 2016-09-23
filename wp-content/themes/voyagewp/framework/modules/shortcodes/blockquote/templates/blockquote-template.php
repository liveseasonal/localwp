<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="mkdf-blockquote-shortcode" <?php voyage_mikado_inline_style($blockquote_style); ?> >
	<span class="mkdf-icon-quotations-holder">
		<span aria-hidden="true" class="icon_quotations"></span>
	</span>
	<h6 class="mkdf-blockquote-text">
		<span><?php echo esc_attr($text); ?></span>
	</h6>
</blockquote>