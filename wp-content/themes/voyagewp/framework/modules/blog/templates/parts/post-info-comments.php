<div class="mkdf-post-info-comments-holder mkdf-post-info-item">
    <a class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
		<span class="mkdf-post-info-comments-icon">
			<?php echo voyage_mikado_icon_collections()->renderIcon('icon_comment_alt', 'font_elegant'); ?>
		</span>
        <?php if($show_comments_label) : ?>
            <?php comments_number('0 '.esc_html__('comments', 'voyage'), '1 '.esc_html__('comment', 'voyage'), '% '.esc_html__('comments', 'voyage')); ?>
        <?php else: ?>
            <?php comments_number('0', '1', '%'); ?>
        <?php endif; ?>
    </a>
</div>