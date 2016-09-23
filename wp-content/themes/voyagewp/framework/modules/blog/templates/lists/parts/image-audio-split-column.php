<?php if(has_post_thumbnail()) { ?>
    <div class="mkdf-post-image">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail('full'); ?>
        </a>
        <?php voyage_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
    </div>
<?php } ?>