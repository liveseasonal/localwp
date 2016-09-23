<div class="mkdf-blog-carousel-holder mkdf-carousel-pagination">
    <?php if($blogQuery->getObject()->have_posts()) : ?>
        <div class="mkdf-blog-carousel">
            <?php while($blogQuery->getObject()->have_posts()) :  ?>
                <?php $blogQuery->getObject()->the_post(); ?>

                <?php $caller->getItemTemplate($params); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php else: ?>
        <p><?php esc_html_e('No posts were found.', 'voyage'); ?></p>
    <?php endif; ?>
</div>