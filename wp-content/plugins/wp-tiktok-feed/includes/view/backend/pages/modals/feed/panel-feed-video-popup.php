<div id="tab_panel_feed_video_popup" class="panel qlttf_options_panel <# if (data.panel != 'tab_panel_feed_video_popup') { #>hidden<# } #>" >

  <div class="options_group"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Videos popup', 'wp-tiktok-feed'); ?></label>
      <input class="media-modal-render-panels" name="popup[display]" type="checkbox" value="true" <# if (data.popup.display){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display popup gallery by clicking on video', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Videos popup profile', 'wp-tiktok-feed'); ?></label> 
      <input name="popup[profile]" type="checkbox" value="true" <# if (data.popup.profile){ #>checked<# } #> />
             <span class="description"><small><?php esc_html_e('Display user profile or tag info', 'wp-tiktok-feed'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Videos popup text', 'wp-tiktok-feed'); ?></label>
      <input name="popup[text]" type="checkbox" value="true" <# if (data.popup.text){ #>checked<# } #> /> 
             <span class="description"><small><?php esc_html_e('Display text in the popup', 'wp-tiktok-feed'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Videos popup likes', 'wp-tiktok-feed'); ?></label>
      <input name="popup[digg_count]" type="checkbox" value="true" <# if (data.popup.digg_count){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display likes count of videos', 'wp-tiktok-feed'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'wp-tiktok-feed'); ?></small></span>
    </p>
    <p class="form-field"> 
      <label><?php esc_html_e('Videos popup comments', 'wp-tiktok-feed'); ?></label>
      <input name="popup[comment_count]" type="checkbox" value="true" <# if (data.popup.comment_count){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display comments count of videos', 'wp-tiktok-feed'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Videos popup align', 'wp-tiktok-feed'); ?></label>
      <select name="popup[align]">
        <option <# if ( data.popup.align == 'left') { #>selected="selected"<# } #> value="left"><?php esc_html_e('Left', 'wp-tiktok-feed'); ?> </option>
        <option <# if ( data.popup.align == 'right') { #>selected="selected"<# } #> value="right"><?php esc_html_e('Right', 'wp-tiktok-feed'); ?> </option>
        <option <# if ( data.popup.align == 'bottom') { #>selected="selected"<# } #> value="bottom"><?php esc_html_e('Bottom', 'wp-tiktok-feed'); ?> </option>
        <option <# if ( data.popup.align == 'top') { #>selected="selected"<# } #> value="top"><?php esc_html_e('Top', 'wp-tiktok-feed'); ?> </option>
      </select>
      <span class="description"><small><?php esc_html_e('Align item description in popup', 'wp-tiktok-feed'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'wp-tiktok-feed'); ?></small></span>
    </p>
  </div>

</div>