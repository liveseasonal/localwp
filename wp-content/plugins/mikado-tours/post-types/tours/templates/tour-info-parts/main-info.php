<?php $main_info_array = mkdf_tours_get_tour_info_table_data(get_the_ID()); ?>
<div class="mkdf-info-section-part mkdf-tour-item-main-info">
    <ul class="mkdf-tour-main-info-holder clearfix">
        <?php
        if(count($main_info_array)) {

            foreach($main_info_array as $item) { ?>

                <?php if($item['value']) { ?>

                    <li class="clearfix <?php if(!empty($item['html_class'])) {
                        echo esc_attr($item['html_class']);
                    } ?>">
                        <div class="col6 mkdf-info">
                            <?php esc_html_e($item['text'], 'mikado-tours'); ?>
                        </div>
                        <div class="col6 mkdf-value">

                            <?php if($item['value']) {

                                if(is_array($item['value']) && count($item['value'])) {
                                    foreach($item['value'] as $item) { ?>

                                        <div class="col6 mkdf-tour-main-info-attr">
                                            <?php esc_html_e($item, 'mikado-tours'); ?>
                                        </div>

                                    <?php }
                                } else {
                                    esc_html_e($item['value'], 'mikado-tours');
                                }

                            }; ?>
                        </div>
                    </li>
                <?php }
            }

        }
        ?>
    </ul>
</div>
