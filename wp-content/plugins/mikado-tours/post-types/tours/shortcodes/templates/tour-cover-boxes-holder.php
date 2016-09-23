<div class="mkdf-tour-cover-boxes-holder">
    <?php if($query->have_posts()) : ?>

        <?php $i = 0; ?>

        <div class="mkdf-tour-cover-boxes-inner" data-active-element="<?php echo esc_attr($active_cover_box); ?>">
            <?php while($query->have_posts()) : ?>
                <?php $query->the_post(); ?>
                <?php if($i < 3) : ?>
                    <div <?php post_class('mkdf-tour-cover-boxes-item-inner'); ?>>
                        <?php $caller->getItemTemplate($params); ?>
                    </div>
                    <?php $i++; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p><?php esc_html_e('No tours match your criteria', 'mikado-tours'); ?></p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>