<div id="tiktok-feed-item-<?php echo esc_attr($item['id']); ?>"
     class="tiktok-feed-item tiktok-feed-cols-<?php echo esc_attr($feed['columns']); ?>
     <?php echo ($feed['layout'] == 'carousel') ? ' swiper-slide nofancybox' : '' ?>" 
     data-item="<?php echo htmlentities(json_encode($item), ENT_QUOTES, 'UTF-8'); ?>" data-elementor-open-lightbox="no">
  <div class="tiktok-feed-item-wrap">
    <?php include($this->template_path('item/item-video.php')); ?>
  </div>
</div>