<ul class="qlttf-tabs">
  <li class="media-modal-tab active">
    <a href="#tab_panel_feed"><span><?php esc_html_e('General', 'wp-tiktok-feed'); ?></span></a>
  </li>
  <# if (data.layout == 'carousel' ){ #>
    <li class="media-modal-tab">
      <a href="#tab_panel_carousel"><span><?php esc_html_e('Carousel', 'wp-tiktok-feed'); ?></span></a>
    </li>
  <# } #>
  <li class="media-modal-tab">
    <a href="#tab_panel_feed_video"><span><?php esc_html_e('Video', 'wp-tiktok-feed'); ?></span></a>
  </li> 
  <li class="media-modal-tab">
    <a href="#tab_panel_feed_video_popup"><span><?php esc_html_e('Popup', 'wp-tiktok-feed'); ?></span></a>
  </li>
  <li class="media-modal-tab">
    <a href="#tab_panel_feed_button"><span><?php esc_html_e('Button', 'wp-tiktok-feed'); ?></span></a>
  </li> 
</ul>