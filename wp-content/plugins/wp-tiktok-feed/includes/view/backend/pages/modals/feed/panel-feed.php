<div id="tab_panel_feed" class="panel qlttf_options_panel <# if (data.panel != 'tab_panel_feed') { #>hidden<# } #>">

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Type', 'wp-tiktok-feed'); ?></label>
      <input type="radio" class="media-modal-render-panels" name="source" value="hashtag" <# if(data.source=='hashtag' ) { #>checked="checked"<# } #> />
        <label><?php esc_html_e('Hashtag', 'wp-tiktok-feed'); ?></label>
        <input type="radio" class="media-modal-render-panels" name="source" value="username" <# if(data.source=='username' ) { #>checked="checked"<# } #> />
          <label><?php esc_html_e('User name', 'wp-tiktok-feed'); ?></label>
    </p>
  </div>

  <div class="options_group">

    <p class="form-field <# if ( data.source != 'username') {#>hidden<#}#>">
      <label><?php esc_html_e('User', 'wp-tiktok-feed'); ?></label>
      <input name="username" type="text" <# if ( data.source=='username' ) {#>required="required"<#}#> placeholder="tiktok" value="{{data.username}}" />
      <span class="description"><small><?php esc_html_e('Please enter TikTok username', 'wp-tiktok-feed'); ?></small></span>
    </p>
    <p class="form-field <# if ( data.source != 'hashtag') {#>hidden<#}#>">
      <label><?php esc_html_e('Hashtag', 'wp-tiktok-feed'); ?></label>
      <input name="hashtag" type="text" <# if ( data.source=='hashtag' ) {#>required="required"<#}#> placeholder="wordpress" value="{{data.hashtag}}" />
      <span class="description"><small><?php esc_html_e('Please enter TikTok tag', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

  <div class="options_group">
    <div class="form-field">
      <ul class="list-videos">
        <li class="media-modal-image <# if ( data.layout == 'masonry') {#>active<#}#>">
          <input type="radio" name="layout" value="masonry" <# if (data.layout=='masonry' ){ #>checked<# } #> />
            <label for="insta_layout-masonry"><?php esc_html_e('Masonry', 'wp-tiktok-feed'); ?>
            </label>
            <img src="<?php echo plugins_url('/assets/backend/img/masonry.png', QLTTF_PLUGIN_FILE); ?>" />
        </li>
        <li class="media-modal-image <# if ( data.layout == 'gallery') {#>active<#}#>">
          <input type="radio" name="layout" value="gallery" <# if (data.layout=='gallery' ){ #>checked<# } #> />
            <label for="insta_layout-gallery"><?php esc_html_e('Gallery', 'wp-tiktok-feed'); ?></label>
            <img src="<?php echo plugins_url('/assets/backend/img/gallery.png', QLTTF_PLUGIN_FILE); ?>" />
        </li>
      </ul>
    </div>
  </div>

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Limit', 'wp-tiktok-feed'); ?></label>
      <input name="limit" type="number" min="1" max="33" value="{{data.limit}}" />
      <span class="description"><small><?php esc_html_e('Number of videos to display', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if(!_.contains(['gallery', 'masonry', 'highlight'], data.layout)) { #>hidden<# } #>">
    <p class="form-field">
      <label><?php esc_html_e('Columns', 'wp-tiktok-feed'); ?></label>
      <input name="columns" type="number" min="1" max="20" value="{{data.columns}}" />
      <span class="description"><small><?php esc_html_e('Number of videos in a row', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

</div>