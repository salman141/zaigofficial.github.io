<?php
// Declare WooCommerce support in theme
add_action( 'after_setup_theme', 'valen_woocommerce_support' );
function valen_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
if(class_exists('WooCommerce')){
    // Remove each woo style one by one
    add_filter( 'woocommerce_enqueue_styles', 'valen_dequeue_woostyles' );
    function valen_dequeue_woostyles( $enqueue_styles ) {
        unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
        unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
        unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
        return $enqueue_styles;
    }
    /*
     * Archive Product
     */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
    add_action( 'woocommerce_before_main_content', 'valen_archive_wrapper_start', 10 );
    add_action( 'woocommerce_after_main_content', 'valen_archive_wrapper_end', 10 );
    
    function valen_archive_wrapper_start() {
        if ( is_shop() || is_product_category() || is_product_tag() ) {
            wp_enqueue_script('isotope');
            echo '<div class="listing-product-main"><div class="listing-product-wrap">';
        }
    }
    function valen_archive_wrapper_end() {
        if ( is_shop() || is_product_category() || is_product_tag() ) echo '</div></div>';
    }
    if ( !is_shop() && !is_product_category() && !is_product_tag() && !is_product() ) {
        add_action( 'valen_before_sns_content', 'valen_woo_message', 10 );
        function valen_woo_message(){
            echo '<div class="woo-message wrap"><div class="container">';
            wc_print_notices();
            echo '</div></div>';
        }
    }
    add_action( 'woocommerce_before_shop_loop', 'valen_archive_title', 2);
    add_action( 'woocommerce_before_shop_loop', 'valen_archive_begin_toolbar_top', 3);
    add_action( 'woocommerce_before_shop_loop', 'valen_sticky_product_filter_btn', 4 );
    add_action( 'woocommerce_before_shop_loop', 'valen_archive_modeview', 5);
    add_action( 'woocommerce_before_shop_loop', 'valen_archive_end_toolbar', 31);
    add_action( 'woocommerce_after_shop_loop', 'valen_archive_begin_toolbar_bottom', 1);
    add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 6);
    add_action( 'woocommerce_after_shop_loop', 'valen_archive_end_toolbar', 31);
    
    // Set modeview
    add_action( 'wp_ajax_sns_setgridcols','valen_set_gridcols' );
    add_action( 'wp_ajax_nopriv_sns_setgridcols', 'valen_set_gridcols' );
    function valen_set_gridcols(){
        setcookie('sns_woo_gridcols', $_POST['gridcols'] , time()+3600*24*100, '/');
    }
    function valen_sticky_product_filter_btn(){
        if ( valen_woo_cat_option('woo_stickypfilter') == true && is_active_sidebar('woo-sidebar-sticky') ){
            echo '<div class="sticky-filter-btn"><span>'.esc_html__('Filter', 'valen').'</span></div>';
        }
    }
    add_action( 'wp_footer', 'valen_sticky_product_filter');
    function valen_sticky_product_filter(){
        if ( valen_woo_cat_option('woo_stickypfilter') == true && is_active_sidebar('woo-sidebar-sticky') ){
            echo '<div class="sticky-product-filter"><div class="inner">';
                dynamic_sidebar('woo-sidebar-sticky');
            echo '</div><span class="overlay"></span></div>';
        }
    }
    function valen_archive_title(){
        if( class_exists('WooCommerce') && is_woocommerce() && is_product_category() ){ 
            $showbreadcrump = valen_woo_cat_option('showbreadcrump');
        }else {
            $showbreadcrump = valen_getoption('showbreadcrump', '1');
        }
        if ( $showbreadcrump != '2' ) return;
        valen_pagetitle();
    }
    function valen_archive_begin_toolbar_top(){
        echo '<div class="toolbar toolbar-top">';
    }
    function valen_archive_begin_toolbar_bottom(){
        echo '<div class="toolbar toolbar-bottom">';
    }
    function valen_archive_end_toolbar(){
        echo '</div>';
    }
    function valen_archive_modeview(){
        $modeview = 'grid';
        if (isset($_COOKIE['sns_woo_list_modeview']) && $_COOKIE['sns_woo_list_modeview']== 'list') {
            $modeview = 'list';
        }?>
        <ul class="mode-view pull-left">
            <li class="grid1">
                <a class="grid<?php echo (esc_attr($modeview)=='grid')?' active':''; ?>" data-mode="grid" href="#" title="<?php echo esc_attr__('Grid', 'valen'); ?>">
                    <span><?php echo esc_html__('Grid', 'valen'); ?></span>
                </a>
            </li>
            <li class="list1">
                <a class="list<?php echo (esc_attr($modeview)=='list')?' active':''; ?>" data-mode="list" href="#" title="<?php echo esc_attr__('List', 'valen'); ?>">
                    <span><?php echo esc_html__('List', 'valen'); ?></span>
                </a>
            </li>
        </ul>
        <?php
    }
    // Set modeview
    add_action( 'wp_ajax_sns_setmodeview','valen_set_modeview' );
    add_action( 'wp_ajax_nopriv_sns_setmodeview', 'valen_set_modeview' );
    function valen_set_modeview(){
        setcookie('sns_woo_list_modeview', $_POST['mode'] , time()+3600*24*100, '/');
    }
    // Slideshow
    add_action( 'valen_before_sns_content', 'valen_woo_cat_slider', 1 );
    function valen_woo_cat_slider(){
        $cat_slideshow = '';
        if ( is_product_category() ) {
            $cat_slideshow = valen_woo_cat_option( 'product_cat_slideshow' );
        } elseif ( is_shop() ) {
            $cat_slideshow = valen_getoption('revolutionslider');
        }
        if( !empty($cat_slideshow) ) { ?>
            <div class="cat-slideshow wrap">
                <?php echo do_shortcode('[rev_slider '.esc_attr($cat_slideshow).' ]'); ?>
            </div>
        <?php
        }
    }
    // Sub cats
    add_action( 'woocommerce_before_main_content', 'valen_archive_subcategories', 2);
    function valen_archive_subcategories(){
        $display_type = woocommerce_get_loop_display_mode();
        if ( 'subcategories' === $display_type || 'both' === $display_type ) { ?>
            <ul class="sub-cats">
            <?php
            woocommerce_output_product_categories( array(
                'parent_id' => is_product_category() ? get_queried_object_id() : 0,
            ) );
            ?>
            </ul>
            <?php
        }
    }
    // Number product per page
    add_filter( 'loop_shop_per_page', 'valen_woo_shop_perpage' );
    function valen_woo_shop_perpage() {
        global $valen_opt;
        if(is_product_category()){
            $valen_number_perpage = valen_woo_cat_option( 'number_perpage' );
            if( $valen_number_perpage != '' )
                return $valen_number_perpage;
        }
        return $valen_opt['woo_number_perpage'];
    }
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    add_action( 'woocommerce_after_shop_loop_item', 'valen_item_addtocart', 10);
    add_action( 'valen_woo_after_product_image', 'valen_item_wishlist_prdimg', 0);
    add_action( 'valen_woo_after_product_image', 'valen_item_variation_colorthumb', 10);
    add_action( 'valen_lv_woo_after_product_image', 'valen_item_variation_colorthumb', 10);
    add_action( 'woocommerce_after_shop_loop_item', 'valen_item_compare', 12);
    function valen_item_variation_colorthumb(){
        global $product;
        if ( $product->get_type() != 'variable' ) { return; }
        $variations = $product->get_variation_attributes();
        if ( !empty($variations) && !isset($variations['pa_color']) && ( isset($variations['pa_color']) && count($variations['pa_color']) ) <= 0 ) { return; }
        ?>
        <div class="variations-product-wrap">
            <div class="variable-item">
        <?php
        $available_variations = $product->get_available_variations();
        $terms = wc_get_product_terms( $product->get_id(), 'pa_color', array( 'fields' => 'all' ));
        foreach ($terms as $term) {
            $type = valen_get_term_byid( $term->term_id, 'valen_product_attribute_type' );
            foreach ($available_variations as $available_variation) {
                if($term->slug === $available_variation['attributes']["attribute_$term->taxonomy"]){
                    $image_var = get_post_thumbnail_id( $available_variation['variation_id'] ); 
                    $image_src = wp_get_attachment_image_src( $image_var, 'shop_catalog');
                    $image_src = isset($image_src['0']) ? $image_src['0'] : '';
                    if ( rwmb_meta('valen_use_variation_thumb', array(), $product->get_id()) != 1 ) {
                        $color = valen_get_term_byid( $term->term_id, 'valen_product_attribute_color' ); ?>
                        <a href="#" class="option color" title="<?php echo esc_attr( $term->name );?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr( $term->name );?>" data-value="<?php echo esc_attr( $term->slug );?>" data-image-src="<?php echo esc_url( $image_src );?>"><span style="background:<?php echo esc_attr( $color );?>"></span></a>
                        <?php
                    }else{  
                        $thumb_src = wp_get_attachment_image_src( $image_var, 'shop_thumbnail');
                        $thumb_src = isset($thumb_src['0']) ? $thumb_src['0'] : '';
                        ?>
                        <a href="#" class="option thumb" title="<?php echo esc_attr( $term->name );?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr( $term->name );?>" data-value="<?php echo esc_attr( $term->slug );?>" data-image-src="<?php echo esc_url( $image_src );?>">
                            <?php echo '<img src="'.esc_url($image_src).'" alt="'.esc_attr($term->name).'"/>'; ?>
                        </a>
                        <?php
                    }
                    break;
                }
            }
        }?>
        </div></div>
        <?php
    }
    function valen_item_addtocart( $args = array() ) {
        global $product;
        if ( $product ) {
            $defaults = array(
                'quantity'   => 1,
                'class'      => implode( ' ', array_filter( array(
                    'button',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                ) ) ),
                'attributes' => array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ),
            );
            $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
            ?>
            <div class="cart-wrap">
            <?php 
            wc_get_template( 'loop/add-to-cart.php', $args );
            ?>
            </div>
            <?php
        }
    }
    function valen_item_wishlist_prdimg(){
        if( class_exists( 'YITH_WCWL' ) ) {
            echo '<div class="wl-prdimg">' . do_shortcode( '[yith_wcwl_add_to_wishlist]' ) . '</div>';
        }
    }
    function valen_item_wishlist(){
        if( class_exists( 'YITH_WCWL' ) ) {
            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
        }
    }
    function valen_item_wishlist2(){
        if( class_exists( 'YITH_WCWL' ) ) {
            apply_filters( 'yith_wcwl_button_label', 'ABC' );
            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
        }
    }
    function valen_item_wishlist_button(){
        global $product;
        if( class_exists( 'YITH_WCWL' ) ) { ?>
            <a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) )?>" rel="nofollow" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-type="<?php echo esc_attr($product->get_type()); ?>">
                <?php echo esc_html__("Wishlist", "valen"); ?>
            </a>
            <?php
        }
    }
    function valen_item_compare(){
        global $product;
        if( class_exists( 'YITH_Woocompare' ) ) {
            $action_add = 'yith-woocompare-add-product';
            $url_args = array(
                'action' => $action_add,
                'id' => $product->get_id()
            );
            ?>
            <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>" class="compare btn btn-primary-outline" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
            <?php echo esc_html__( 'Compare', 'valen' ); ?>
            </a>
            <?php
        }
    }
    /** 
     *  Quick view for product list style
     **/
    function valen_quickview_liststyle(){
        if ( !class_exists('YITH_WCQV_Frontend') ) return;
        global $product;
        $product_id = 0;
        // get product id
        ! $product_id && $product_id = yit_get_prop( $product, 'id', true );
        $button = '<a href="#" class="button yith-wcqv-button" data-product_id="' . esc_attr($product_id) . '">'.esc_html__('Quick view', 'valen').'</a>';
        echo apply_filters( 'yith_add_quick_view_button_html', $button, esc_html__('Quick view', 'valen'), $product );
    }
    // Override thumbnail
    function valen_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
        if( valen_themeoption('woo_uselazyload', 0) == 1 || ( isset($attr['class']) && strpos($attr['class'], 'use-zoom') !== false ) ){
            $id = get_post_thumbnail_id(); 
            if ( !$id ) return $html;
            $src = wp_get_attachment_image_src($id, $size);
            $alt = get_the_title($id);
            $class = ( isset($attr['class']) ) ? $attr['class'] : '';
            $img_new = '<img alt="'.esc_attr($alt).'" class="' . esc_attr($class) . '"';
            if (strpos($class, 'lazy') !== false) {
                $img_new .= ' data-original="' . esc_url($src[0]) . '"';
                if ( strpos($class, 'attachment-shop_single') !== false) {
                    $img_new .= ' src="'.VALEN_THEME_URI.'/assets/img/prod_loading_3.gif"';
                } else {
                    $img_new .= ' src="'.VALEN_THEME_URI.'/assets/img/prod_loading.gif"';
                }
            }else{
                $img_new .= ' src="' . esc_url($src[0]) . '"';
            }
            if (strpos($class, 'use-zoom') !== false) {
                $src_full = wp_get_attachment_image_src($id, 'full');
                $img_new .= ' data-zoom-image="'. esc_url($src_full[0]) .'"';
            }
            $img_new .= '/>';
            return $img_new;
        }
        return $html;
    }
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'valen_product_thumbnail', 11 );
    add_action( 'valen_grid4_before_shop_loop_item_title', 'valen_product_thumbnail_grid1', 11 );
    add_filter('post_thumbnail_html', 'valen_post_thumbnail_html', 99, 5);
    function valen_product_thumbnail_grid1(){
        global $post;
        $size = 'shop_catalog';
        $class = 'attachment-shop_catalog use-zoom';
        if ( has_post_thumbnail() ) {
            if( valen_themeoption('woo_uselazyload', 0) == 1 ){
                $class .= ' lazy';
                echo get_the_post_thumbnail( $post->ID, $size, array('class' => $class) );
            }else{
                echo get_the_post_thumbnail( $post->ID, $size, array('class' => $class) );
            }
        } elseif ( wc_placeholder_img_src() ) {
            echo wc_placeholder_img( $size );
        }
    }
    function valen_product_thumbnail(){
        global $post;
        $size = 'shop_catalog';
        $class = 'attachment-shop_catalog';
        if ( has_post_thumbnail() ) {
            if( valen_themeoption('woo_uselazyload', 0) == 1 ){
                $class .= ' lazy';
                echo get_the_post_thumbnail( $post->ID, $size, array('class' => $class) );
            }else{
                echo get_the_post_thumbnail( $post->ID, $size );
            }
        } elseif ( wc_placeholder_img_src() ) {
            echo wc_placeholder_img( $size );
        }
    }
    function valen_single_product_thumbnail(){
        global $post;
        $size = 'shop_single';
        if ( has_post_thumbnail() ) {
            if( valen_themeoption('woo_uselazyload', 0) == 1 ){
                echo get_the_post_thumbnail( $post->ID, $size, array('class' => "lazy attachment-shop_single") );
            }else{
                echo get_the_post_thumbnail( $post->ID, $size );
            }
        } elseif ( wc_placeholder_img_src() ) {
            echo wc_placeholder_img( $size );
        }
    }
    add_action('woocommerce_single_product_summary', 'valen_woo_single_countdown', 25);
    function valen_woo_single_countdown () {
        global $post, $product;
        // Get the Sale Price Date To of the product
        $sale_price_dates_to = ( $date = get_post_meta( $post->ID, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
        if(!empty($sale_price_dates_to)):
            // Set sale price date to default 10 days for http://demo.snstheme.com/
            if( strpos(site_url(), 'demo.snstheme.com') || strpos(site_url(), 'dev.snsgroup.me') ){
                if($sale_price_dates_to == 0) $sale_price_dates_to = date('Y/m/d', strtotime('+10 days'));
            }
            wp_enqueue_script('jquery-countdown');
            $uq = rand().time();
            ?>
            <div class="time-count-down" id="sns-tcd-<?php echo esc_attr($uq); ?>" data-date="<?php echo esc_attr($sale_price_dates_to); ?>">
                <div class="clock-digi">
                    <div><div><div class="day"></div><?php esc_html_e('Days', 'valen');?></div></div>
                    <div><div><div class="hours"></div><?php esc_html_e('Hours', 'valen');?></div></div>
                    <div><div><div class="minutes"></div><?php esc_html_e('Mins', 'valen');?></div></div>
                    <div><div><div class="seconds"></div><?php esc_html_e('Secs', 'valen');?></div></div>
                </div>
            </div>
        <?php endif;
    }
    function valen_woo_special_countdown () {
        global $post, $product;
        // Get the Sale Price Date To of the product
        $sale_price_dates_to = ( $date = get_post_meta( $post->ID, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
            // Set sale price date to default 23 hours
            if( strpos(site_url(), 'demo.snstheme.com') || strpos(site_url(), 'dev.snsgroup.me') ){
                if($sale_price_dates_to == 0 || $sale_price_dates_to <= date('Y/m/d') ) $sale_price_dates_to = date('Y/m/d', strtotime('+10 days'));
            }
            wp_enqueue_script('jquery-countdown');
            $uq = rand().time();
            ?>
            <div class="time-count-down" id="sns-tcd-<?php echo esc_attr($uq); ?>" data-date="<?php echo esc_attr($sale_price_dates_to); ?>">
                <div class="clock-digi">
                    <div><div><div class="day"></div><?php esc_html_e('Days', 'valen');?></div></div>
                    <div><div><div class="hours"></div><?php esc_html_e('Hours', 'valen');?></div></div>
                    <div><div><div class="minutes"></div><?php esc_html_e('Mins', 'valen');?></div></div>
                    <div><div><div class="seconds"></div><?php esc_html_e('Secs', 'valen');?></div></div>
                </div>
            </div>
        <?php
    }
    function valen_special_sold_bar(){
        global $product;
        //if ( $product->get_stock_quantity() <= 0 ) return; 
        ?>
        <div class="sold-bar">
            <div class="the-bar">
                <?php $precent = ( $product->get_total_sales() < $product->get_stock_quantity() ) ? ($product->get_total_sales()/$product->get_stock_quantity())*100 : '0'; ?>
                <span data-width="<?php echo esc_attr($precent); ?>%"></span>
            </div>
            <div class="num-sold">
                <?php 
                $sold = $product->get_total_sales() ;
                echo esc_html__('Sold: ', 'valen') . $sold;
                if ( $sold > 1) {
                    echo ' '.esc_html__('items', 'valen');
                } else {
                    echo ' '.esc_html__('item', 'valen');
                }?>
            </div>
            <div class="num-stock">
                <?php 
                $stock = $product->get_stock_quantity() ; 
                echo esc_html__('Available: ', 'valen') . $stock;
                if ( $stock > 1) {
                    echo ' '.esc_html__('items', 'valen');
                } else {
                    echo ' '.esc_html__('item', 'valen');
                }?>
            </div>
        </div>
        <?php
    }
    function valen_discount_percent(){
        global $product;
        if ( $product->get_sale_price() ) {
            echo '<span class="badge-discount-percent">-' . round ( ( ( $product->get_regular_price() - $product->get_sale_price() ) * 100 ) / $product->get_regular_price() ) . '%</span>';
        }
    }
    function valen_woo_cat_links(){
        global $product;
        echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="cat-links">', '</div>' );
    }
    function valen_woo_query($type, $post_per_page=-1, $cat='', $offset=0, $paged=1){
        global $woocommerce;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'offset'            => $offset,
            'paged' => $paged
        );
        switch ($type) {
            case 'best_selling':
                $args['meta_key']='total_sales';
                $args['orderby']='meta_value_num';
                $args['ignore_sticky_posts']   = 1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $args['ignore_sticky_posts']=1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = wc_get_featured_product_ids();
                break;
            case 'top_rate':
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby']  = array(
                    'meta_value_num' => 'DESC',
                    'ID'             => 'ASC',
                );
                break;
            case 'recent':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'on_sale':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = wc_get_product_ids_on_sale();
                break;
            case 'hot_deal':
                global $wpdb;
                $query = $wpdb->prepare("
                    SELECT posts.ID, posts.post_parent
                    FROM {$wpdb->prefix}posts posts
                    INNER JOIN {$wpdb->prefix}postmeta ON (posts.ID = {$wpdb->prefix}postmeta.post_id)
                    INNER JOIN {$wpdb->prefix}postmeta AS mt1 ON (posts.ID = mt1.post_id)
                    WHERE
                        posts.post_status = 'publish'
                        AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= %s) 
                        GROUP BY posts.ID 
                        ORDER BY %s", time(), "ASC");
                $product_ids_raw = $wpdb->get_results($query);
                $product_ids_hotdeal = array();
                foreach ( $product_ids_raw as $product_raw ) {
                    if(!empty($product_raw->post_parent)){
                        $product_ids_hotdeal[] = $product_raw->post_parent;
                    }else{
                        $product_ids_hotdeal[] = $product_raw->ID;  
                    }
                }
                $product_ids_hotdeal = array_unique($product_ids_hotdeal);
                if ( is_array($product_ids_hotdeal) && count($product_ids_hotdeal) == 0 ) {
                    $product_ids_hotdeal = wc_get_product_ids_on_sale(); 
                }
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = $product_ids_hotdeal;
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = $wpdb->prepare( "
                    SELECT c.comment_post_ID 
                    FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c 
                    WHERE p.ID = c.comment_post_ID AND c.comment_approved > %d 
                    AND p.post_type = %s AND p.post_status = %s
                    AND p.comment_count > %d ORDER BY c.comment_date ASC" ,
                    0, 'product', 'publish', 0 );
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = $_pids;
                break;
        }
        if($cat!=''){
            $args['product_cat']= $cat;
        }
        return new WP_Query($args);
    }
    /*
     * Single Product
     */
    // Share box in product page
    if ( valen_themeoption('woo_sharebox') == 1 ) {
        add_action('woocommerce_share', 'valen_sharebox', 22);
    }
    // Rename product tab
    add_filter( 'woocommerce_product_tabs', 'valen_woo_rename_tabs', 98 );
    function valen_woo_rename_tabs( $tabs ) {
        if ( isset($tabs['description']) ) {
            $tabs['description']['title'] = esc_html__( 'Description', 'valen' );
        }
        if ( isset($tabs['additional_information']) ) {
            $tabs['additional_information']['title'] = esc_html__( 'Additional','valen' );   // Rename the additional information tab
        }
        return $tabs;
    }
    // Add clear for product summary
    add_action( 'woocommerce_single_product_summary', 'valen_woo_addclear', 35 );
    function valen_woo_addclear() {
        echo '<div class="clear"></div>';
    }
    // Cross sells
    add_filter( 'woocommerce_cross_sells_total', 'limit_woocommerce_cross_sells_total' );
    function limit_woocommerce_cross_sells_total() {
        return 6;
    }
    // Re-render rating
    add_filter( 'woocommerce_product_get_rating_html', 'valen_get_rating_html', 100, 2 );
    function valen_get_rating_html(){
        global $woocommerce, $product;
        if( $product && $product->get_average_rating() ) $rating = $product->get_average_rating();
        if( isset($rating) && $rating > 0){
            $rating_html  = '<div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'valen' ), $rating ) . '">';
            $rating_html .= '<span class="value" data-width="' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5', 'valen' ) . '</span>';
        }else{
            $rating_html  = '<div class="star-rating">';
        }
        $rating_html .= '</div>';
        return $rating_html;
    }
    function valen_woo_product_list_title() {
        echo '<div class="item-title woocommerce-loop-product__title"><a href="'.get_the_permalink().'" title="'.get_the_title().'">' . valen_limitcharacter( get_the_title(), 30) . '</a></div>';
    }
    // Override product title
    function woocommerce_template_loop_product_title() {
        echo '<div class="item-title woocommerce-loop-product__title"><a href="'.get_the_permalink().'" title="'.get_the_title().'">' . get_the_title() . '</a></div>';
    }
    // Class for Woo
	class valen_Woocommerce{
        public $revsliders = array();
		public static function getInstance(){
			static $_instance;
			if( !$_instance ){
				$_instance = new valen_Woocommerce();
			}
			return $_instance;
		}
		public function __construct(){
            global $wpdb;
            $this->revsliders[0] = 'Select a slider';
            if ( class_exists('RevSlider') ) {
                $query = $wpdb->prepare("
                    SELECT * 
                    FROM {$wpdb->prefix}revslider_sliders 
                    ORDER BY %s"
                    , "ASC");
                $get_sliders = $wpdb->get_results($query);
                if($get_sliders) {
                    foreach($get_sliders as $slider) {
                       $this->revsliders[$slider->alias] = $slider->title;
                   }
                }
            }
            // Add Taxonomy product_cat custom meta fields
            add_action('product_cat_add_form_fields', array(&$this, 'valen_product_cat_add_new_meta_field'), 20, 3);
            add_action('product_cat_edit_form_fields', array(&$this, 'valen_product_cat_edit_meta_field'), 20, 3);
            // Save extra taxonomy fields callback function
            add_action( 'edit_term', array(&$this,'valen_save_product_cat_custom_meta'), 10, 3 );
            add_action( 'created_term', array(&$this,'valen_save_product_cat_custom_meta'), 10, 3 );
            // Add Taxonomy product_attributes custom meta fields
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if ( $attribute_taxonomies ) {
                foreach ( $attribute_taxonomies as $attribute) {
                    add_action( 'pa_' . $attribute->attribute_name . '_add_form_fields', array(&$this, 'valen_product_attribute_add_new_meta_field'), 20, 3 );
                    add_action( 'pa_' . $attribute->attribute_name . '_edit_form_fields', array(&$this, 'valen_product_attribute_edit_meta_field'), 20, 3);
                    add_action( 'pa_' . $attribute->attribute_name . '_edit_form_fields', array(&$this, 'valen_termattr_js'));
                    add_action( 'pa_' . $attribute->attribute_name . '_add_form_fields', array(&$this, 'valen_termattr_js'));
                    add_action( 'edit_term', array(&$this,'valen_product_attribute_save_custom_meta'), 10, 3 );
                    add_action( 'created_term', array(&$this,'valen_product_attribute_save_custom_meta'), 10, 3 );
                }
            }
		}
        // Add term page
        public function valen_product_cat_add_new_meta_field(){
            // This will add the custom meta field  to the add new term page
            $revsliders = $this->revsliders;
            ?>
            <div class="form-field term-valen_woo_stickypfilter">
                <label for="valen_woo_stickypfilter"><?php esc_html_e( "Sticky product filter in left", 'valen' ); ?></label>
                <select name="valen_woo_stickypfilter" id="valen_woo_stickypfilter">
                    <option value=""><?php esc_html_e('Default', 'valen');?></option>
                    <option value="1"><?php esc_html_e('Yes', 'valen');?></option>
                    <option value="0"><?php esc_html_e('No', 'valen');?></option>
                </select>
            </div>
            <div class="form-field term-valen_showbreadcrump">
                <label for="valen_showbreadcrump"><?php esc_html_e( "Show Breadcrumbs?", 'valen' ); ?></label>
                <select name="valen_showbreadcrump" id="valen_showbreadcrump">
                    <option value=""><?php esc_html_e('Default', 'valen');?></option>
                    <option value="1"><?php esc_html_e('Yes', 'valen');?></option>
                    <option value="2"><?php esc_html_e('No', 'valen');?></option>
                </select>
            </div>
            <div class="form-field term-valen_product_cat_slideshow">
                <label for="valen_product_cat_slideshow"><?php esc_html_e( 'Slideshow', 'valen' ); ?></label>
                <select name="valen_product_cat_slideshow" id="valen_product_cat_slideshow">
                    <?php
                    foreach ($revsliders as $key => $value):?>
                       <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
                <p class="description"><?php esc_html_e( 'Select Slideshow.','valen' ); ?></p>
            </div>
            <div class="form-field term-valen_product_cat_layout">
                <label for="valen_product_cat_layout"><?php esc_html_e( 'Layout', 'valen' ); ?></label>
                <select name="valen_product_cat_layout" id="valen_product_cat_layout">
                    <option value=""><?php esc_html_e('Default (Layout of Shop page)', 'valen');?></option>
                    <option value="m"><?php esc_html_e('Without sidebar', 'valen');?></option>
                    <option value="l-m"><?php esc_html_e('Left Sidebar', 'valen');?></option>
                    <option value="m-r"><?php esc_html_e('Right Sidebar', 'valen');?></option>
                </select>
                <p class="description"><?php esc_html_e( 'Set the layout fullwidth or has sidebar (Woo Sidebar).','valen' ); ?></p>
            </div>
            <div class="form-field term-valen_woo_gridstyle">
                <label for="valen_woo_gridstyle"><?php esc_html_e( 'Grid style', 'valen' ); ?></label>
                <select name="valen_woo_gridstyle" id="valen_woo_gridstyle">
                    <option value=""><?php esc_html_e('Default', 'valen');?></option>
                    <option value="1">Style 1</option>
                    <option value="2">Style 2</option>
                    <option value="3">Style 3</option>
                    <option value="4">Style 4</option>
                </select>
            </div>
            <div class="form-field term-valen_woo_grid_col">
                <label for="valen_woo_grid_col"><?php esc_html_e( 'Grid columns', 'valen' ); ?></label>
                <select name="valen_woo_grid_col" id="valen_woo_grid_col">
                    <option value=""><?php esc_html_e('Default', 'valen');?></option>
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="1">6</option>
                </select>
                <p class="description"><?php esc_html_e( 'We are using grid bootstap - 12 cols layout. Default use in Theme Options.','valen' ); ?></p>
            </div>
            <div class="form-field term-valen_number_perpage">
                <label for="valen_number_perpage"><?php esc_html_e( 'Number products per listing page', 'valen' ); ?></label>
                <input name="valen_number_perpage" id="valen_number_perpage" type="text" value="12" size="40">
            </div>
            <?php
        }
        // Edit term page
        public function valen_product_cat_edit_meta_field($term, $taxonomy){
            $revsliders = $this->revsliders;
            $valen_woo_stickypfilter = valen_get_term_byid( $term->term_id, 'valen_woo_stickypfilter' );
            $valen_showbreadcrump = valen_get_term_byid( $term->term_id, 'valen_showbreadcrump' );
            $valen_product_cat_slideshow = valen_get_term_byid( $term->term_id, 'valen_product_cat_slideshow' );
            $valen_product_cat_layout = valen_get_term_byid( $term->term_id, 'valen_product_cat_layout' );
            $valen_woo_gridstyle = valen_get_term_byid( $term->term_id, 'valen_woo_gridstyle' );
            $valen_woo_grid_col = valen_get_term_byid( $term->term_id, 'valen_woo_grid_col' );
            $valen_number_perpage = valen_get_term_byid( $term->term_id, 'valen_number_perpage' );
            ?>
            <tr class="form-field term-valen_woo_stickypfilter">
                <th scope="row"><label for="valen_woo_stickypfilter"><?php esc_html_e( "Sticky product filter in left", 'valen' ); ?></label></th>
                <td>
                    <select name="valen_woo_stickypfilter" id="valen_woo_stickypfilter">
                        <option value="" <?php selected($valen_woo_stickypfilter, '', true)?>><?php esc_html_e('Default', 'valen');?></option>
                        <option value="1" <?php selected($valen_woo_stickypfilter, '1', true)?>><?php esc_html_e('Yes', 'valen');?></option>
                        <option value="0" <?php selected($valen_woo_stickypfilter, '0', true)?>><?php esc_html_e('No', 'valen');?></option>
                    </select>
                </td>
            </tr>
            <tr class="form-field term-valen_showbreadcrump">
                <th><label for="valen_showbreadcrump"><?php esc_html_e( "Show Breadcrumbs?", 'valen' ); ?></label></th>
                <td>
                    <select name="valen_showbreadcrump" id="valen_showbreadcrump">
                        <option value="" <?php selected($valen_showbreadcrump, '', true)?>><?php esc_html_e('Default', 'valen');?></option>
                        <option value="1" <?php selected($valen_showbreadcrump, '1', true)?>><?php esc_html_e('Yes', 'valen');?></option>
                        <option value="2" <?php selected($valen_showbreadcrump, '2', true)?>><?php esc_html_e('No', 'valen');?></option>
                    </select>
                </td>
            </tr>
            <tr class="form-field valen_product_cat_slideshow">
                <th scope="row"><label for="valen_product_cat_slideshow"><?php esc_html_e( 'Slideshow', 'valen' ); ?></label></th>
                <td>
                    <select name="valen_product_cat_slideshow" id="valen_product_cat_slideshow">
                        <?php
                        foreach ($revsliders as $key => $value):?>
                           <option value="<?php echo esc_attr($key); ?>" <?php selected($valen_product_cat_slideshow, $key, true)?>><?php echo esc_html($value); ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <p class="description"><?php esc_html_e( 'Select Slideshow.','valen' ); ?></p>
                </td>
            </tr>
            <tr class="form-field valen_product_cat_layout">
                <th scope="row"><label for="valen_product_cat_layout"><?php esc_html_e( 'Layout', 'valen' ); ?></label></th>
                <td>
                    <select name="valen_product_cat_layout" id="valen_product_cat_layout">
                        <option value="" <?php selected($valen_product_cat_layout, '', true)?>><?php esc_html_e('Default (Layout of Shop page)', 'valen');?></option>
                        <option value="m" <?php selected($valen_product_cat_layout, 'm', true)?>><?php esc_html_e('Without sidebar', 'valen');?></option>
                        <option value="l-m" <?php selected($valen_product_cat_layout, 'l-m', true)?>><?php esc_html_e('Left Sidebar', 'valen');?></option>
                        <option value="m-r" <?php selected($valen_product_cat_layout, 'm-r', true)?>><?php esc_html_e('Right Sidebar', 'valen');?></option>
                    </select>
                    
                    <p class="description"><?php esc_html_e( 'Set the layout is without sidebar or has sidebar (Woo Sidebar).','valen' ); ?></p>
                </td>
            </tr>
            <tr class="form-field valen_woo_gridstyle">
                <th scope="row"><label for="valen_woo_gridstyle"><?php esc_html_e( 'Grid style', 'valen' ); ?></label></th>
                <td>
                    <select name="valen_woo_gridstyle" id="valen_woo_gridstyle">
                        <option value="" <?php selected($valen_woo_gridstyle, '', true)?>><?php esc_html_e('Default', 'valen');?></option>
                        <option value="1" <?php selected($valen_woo_gridstyle, '1', true)?>>Style 1</option>
                        <option value="2" <?php selected($valen_woo_gridstyle, '2', true)?>>Style 2</option>
                        <option value="3" <?php selected($valen_woo_gridstyle, '3', true)?>>Style 3</option>
                        <option value="4" <?php selected($valen_woo_gridstyle, '4', true)?>>Style 4</option>
                    </select>
                </td>
            </tr>
            <tr class="form-field valen_woo_grid_col">
                <th scope="row"><label for="valen_woo_grid_col"><?php esc_html_e( 'Grid columns', 'valen' ); ?></label></th>
                <td>
                    <select name="valen_woo_grid_col" id="valen_woo_grid_col">
                        <option value="" <?php selected($valen_woo_grid_col, '', true)?>><?php esc_html_e('Default', 'valen');?></option>
                        <option value="1" <?php selected($valen_woo_grid_col, '1', true)?>>1</option>
                        <option value="2" <?php selected($valen_woo_grid_col, '2', true)?>>2</option>
                        <option value="3" <?php selected($valen_woo_grid_col, '3', true)?>>3</option>
                        <option value="4" <?php selected($valen_woo_grid_col, '4', true)?>>4</option>
                        <option value="5" <?php selected($valen_woo_grid_col, '5', true)?>>5</option>
                        <option value="6" <?php selected($valen_woo_grid_col, '6', true)?>>6</option>
                    </select>
                    <p class="description"><?php esc_html_e( 'We are using grid bootstap - 12 cols layout. Default use in Theme Options.','valen' ); ?></p>
                </td>
            </tr>
            <tr class="form-field valen_number_perpage">
                <th scope="row"><label for="valen_number_perpage"><?php esc_html_e( 'Number products per listing page', 'valen' ); ?></label></th>
                <td>
                    <input name="valen_number_perpage" id="valen_number_perpage" type="text" value="<?php echo esc_attr($valen_number_perpage);?>" size="40">
                </td>
            </tr>
            <?php
        }
        // Save term page
        public function valen_save_product_cat_custom_meta($term_id, $tt_id, $taxonomy){
            $fields = array(
                'valen_woo_stickypfilter',
                'valen_showbreadcrump',
                'valen_product_cat_slideshow',
                'valen_product_cat_layout',
                'valen_woo_gridstyle',
                'valen_woo_grid_col',
                'valen_number_perpage'
            );
            foreach ($fields as $field){
                if( isset($_POST[$field]) ){
                    $value = $_POST[$field];
                    update_woocommerce_term_meta($term_id, $field, $value);
                }
            }
        }
        //Add term page for product_attribute
        public function valen_product_attribute_add_new_meta_field(){
            // This will add the custom meta field  to the add new term page
            ?>
            <div class="form-field term-valen_product_attribute_type">
                <label for="valen_product_attribute_type"><?php esc_html_e( 'Type', 'valen' ); ?></label>
                <select name="valen_product_attribute_type" id="valen_product_attribute_type">
                    <option value="text"><?php esc_html_e('Text', 'valen');?></option>
                    <option value="color"><?php esc_html_e('Color Picker', 'valen');?></option>
                </select>
                <p class="description"></p>
            </div>
            <div class="form-field term-valen_product_attribute_color">
                <label for="valen_product_attribute_color"><?php esc_html_e( 'Color Picker', 'valen' ); ?></label>
                <input type="text" class="colorpicker sns-colorpicker" value="" name="valen_product_attribute_color"/>
                <p class="description"></p>
            </div>
            <?php
        }
        // Term attribute js
        function valen_termattr_js(){
            wp_enqueue_script('valen-termattr', VALEN_THEME_URI . '/assets/js/sns-woo-termattr.js', array('jquery'), '', true);
        }
        // Edit term page
        public function valen_product_attribute_edit_meta_field($term, $taxonomy){
            $valen_product_attribute_type = valen_get_term_byid( $term->term_id, 'valen_product_attribute_type' );
            $valen_product_attribute_color = valen_get_term_byid( $term->term_id, 'valen_product_attribute_color' );
            ?>
            <tr class="form-field valen_product_attribute_type">
                <th scope="row"><label for="valen_product_attribute_type"><?php esc_html_e( 'Type', 'valen' ); ?></label></th>
                <td>
                    <select name="valen_product_attribute_type" id="valen_product_attribute_type">
                        <option value="text" <?php selected($valen_product_attribute_type, 'text', true)?>><?php esc_html_e('Text', 'valen');?></option>
                        <option value="color" <?php selected($valen_product_attribute_type, 'color', true)?>><?php esc_html_e('Color Picker', 'valen');?></option>
                    </select>
                    <p class="description"></p>
                </td>
            </tr>
            <tr class="form-field term-valen_product_attribute_color">
                <th scope="row"><label for="valen_product_attribute_color"><?php esc_html_e( 'Color Picker', 'valen' ); ?></label></th>
                <td>
                    <input type="text" class="colorpicker sns-colorpicker" value="<?php echo esc_attr( $valen_product_attribute_color );?>" name="valen_product_attribute_color"/>
                    <p class="description"></p>
                </td>
            </tr>
            <?php
        }
        // Save term page
        public function valen_product_attribute_save_custom_meta($term_id, $tt_id, $taxonomy){
            $fields = array(
                'valen_product_attribute_type',
                'valen_product_attribute_color',
                'valen_product_attribute_image_id'
            );
            foreach ($fields as $field){
                if( isset($_POST[$field]) ){
                    $value = !empty($_POST[$field]) ? $_POST[$field] : '';
                    
                    update_woocommerce_term_meta($term_id, $field, $value);
                }
            }
        }
	}
	valen_Woocommerce::getInstance();
}
