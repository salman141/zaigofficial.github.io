<div class="wrap about-wrap full-width-layout">
  <form method="post">
    <p class="submit"> 
      <?php submit_button(esc_html__('+ Feed', 'btn-instagram'), 'primary', 'submit', false, array('id' => 'qlttf-add-feed')); ?>
    </p>
    <table id="qlttf_feeds_table" class="form-table widefat striped">
      <thead>
        <tr>
          <th><?php esc_html_e('Image', 'wp-tiktok-feed'); ?></th> 
          <th><?php esc_html_e('Feed', 'wp-tiktok-feed'); ?></th>
          <th><?php esc_html_e('Name', 'wp-tiktok-feed'); ?></th>
          <th><?php esc_html_e('Videos', 'wp-tiktok-feed'); ?></th>
          <th><?php esc_html_e('Layout', 'wp-tiktok-feed'); ?></th>
          <th><?php esc_html_e('Shortcode', 'wp-tiktok-feed'); ?></th>
          <th><?php esc_html_e('Actions', 'wp-tiktok-feed'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $position = 1;

        foreach ($feeds as $id => $feed) {

          if (!isset($feed['source']))
            continue;
          
          if ($feed['source'] == 'username') {
            $profile_info = qlttf_get_username_profile($feed['username']);
          } else {
            $profile_info = qlttf_get_hashtag_profile($feed['hashtag']);
          }
          
          ?>
          <tr class="<?php if ($position > 1)  ?>" data-feed_id="<?php echo esc_attr($id) ?>" data-feed_position="<?php echo esc_attr($position) ?>"> 
            <td width="1%">
              <img class="qlttf-avatar" src="<?php echo esc_url($profile_info['profile_pic_url']); ?>" />
            </td>
            <td width="1%">
              <?php echo esc_html($profile_info['username']); ?>
            </td>
            <td width="1%">
              <?php echo esc_html($profile_info['full_name']); ?>
            </td>
            <td width="1%">
              <?php echo esc_html($profile_info['video_count']); ?>
            </td>
            <td>
              <?php echo esc_html(ucfirst($feed['layout'])); ?>
            </td>
            <td>
              <input id="<?php echo esc_attr($id); ?>-feed-shortcode" type="text" value='[tiktok-feed id="<?php echo esc_attr($id); ?>"]' readonly />
              <a href="javascript:;" data-qlttf-copy-feed-shortcode="#<?php echo esc_attr($id); ?>-feed-shortcode" class="button button-secondary">
                <i class="dashicons dashicons-edit"></i><?php esc_html_e('Copy', 'wp-tiktok-feed'); ?>
              </a>
            </td>
            <td> 
              <a href="javascript:;" class="qlttf_edit_feed button button-primary" title="<?php esc_html_e('Edit feed', 'wp-tiktok-feed'); ?>"><?php esc_html_e('Edit'); ?></a>
              <a href="javascript:;" class="qlttf_clear_cache button button-secondary" title="<?php esc_html_e('Clear feed cache', 'wp-tiktok-feed'); ?>"><i class="dashicons dashicons dashicons-update"></i><?php esc_html_e('Cache', 'wp-tiktok-feed'); ?></a>
              <a href="javascript:;" class="qlttf_delete_feed" title="<?php esc_html_e('Delete feed', 'wp-tiktok-feed'); ?>"><?php esc_html_e('Delete'); ?></a> 
              <span class="spinner"></span>
            </td>
          </tr>
          <?php
          $position++;
        } unset($i);
        ?>
      </tbody>
    </table>
  </form>
</div>

<?php include_once('modals/template-scripts-feed.php'); ?> 