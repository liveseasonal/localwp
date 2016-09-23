<?php
if(get_the_excerpt() !== '') : ?>
    <div class="mkdf-info-section-part mkdf-tour-item-excerpt">
        <?php the_excerpt(); ?>
    </div>
<?php endif; ?>