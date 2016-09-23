<div class="mkdf-tours-carousel-holder mkdf-carousel-pagination <?php echo esc_attr($hover_class);?>">
    <?php if($query->have_posts()) : ?>
        <div class="mkdf-tours-carousel">

            <?php while($query->have_posts()) : ?>
                <?php $query->the_post(); ?>
                <div <?php post_class('mkdf-tour-carousel-item-inner'); ?>>
                    <?php $caller->getItemTemplate($tour_type, $params); ?>
                </div>
            <?php endwhile; ?>

        </div>
    <?php else: ?>
        <p><?php esc_html_e('No tours match your criteria', 'mikado-tours'); ?></p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>