<?php 
/**
 * Templates Name: Elementor
 * Widget: Account
 */
$this->add_render_attribute('tbay-login', 'class', 'tbay-login');
$this->add_render_attribute('sub-menu', 'class', 'account-menu sub-menu');
$this->add_render_attribute('wrapper', 'class', ['header-icon']);

$settings = $this->get_settings_for_display();

extract($settings); 

$catalog_mode = diza_catalog_mode_active();
if( $catalog_mode ) return;

$url_login = apply_filters('diza_woocommerce_my_account_url', get_permalink(wc_get_page_id('myaccount') ) );
?>
    <div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
        <div <?php echo trim($this->get_render_attribute_string('tbay-login')); ?>>
            <?php
                if(is_user_logged_in()) {
                    ?>
                    <a href="<?php echo esc_url($url_login) ?>" class="account-button">
                        <?php $this->render_item_account(); ?>
                    </a>
                    <?php
                    if($show_sub_account === 'yes') {
                        ?>
                        <div <?php echo trim($this->get_render_attribute_string('sub-menu')); ?>>
                            <?php $this->render_sub_menu(); ?>
                        </div> 
                        <?php
                    }
                }
                elseif(!is_user_logged_in()) { 

                    if($show_popup_login === 'yes') {
                        $url    = '#custom-login-wrapper';
                        $target = " data-toggle=modal data-target=#custom-login-wrapper";
                        ?>
                            <a <?php echo trim($target)?> href="<?php echo esc_url($url) ?>">
                                <?php $this->render_item_account(); ?>
                            </a>  
                        <?php
                    }
                    else {
                        ?> 
                        <?php $url = get_permalink(wc_get_page_id('myaccount')); ?>
                        <a href="<?php echo esc_url($url) ?>" class="account-button">
                            <?php $this->render_item_account(); ?>
                        </a>
                    <?php
                    }
                }
            ?>
        </div>
</div>
