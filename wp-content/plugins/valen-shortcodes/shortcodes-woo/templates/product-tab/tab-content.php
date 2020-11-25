<?php
$_tab_type       = ( isset($tab_args['tab_type']) ) ? $tab_args['tab_type'] : $tab_type ;
if ( $_tab_type == 1 ) {
    $orderby        = explode(',', $orderby_tab);
    $_orderby       = ( isset($tab_args['order']) ) ? $tab_args['order'] : $orderby[0] ;
    $_cat           = ( isset($tab_args['cat']) ) ? $tab_args['cat'] : $cat ;
    $_content_id    = ( isset($tab_args['tab_content_id']) ) ? $tab_args['tab_content_id'] : $_orderby.'_'.$uq ;
}else{
    $cat = explode(',', $cat_tab);
    if ( $show_tab_all == '1' ) {
        // Fist content is all cat
        $_cat           = ( isset($tab_args['cat']) ) ? $tab_args['cat'] : '' ;
        $_content_id    = ( isset($tab_args['tab_content_id']) ) ? $tab_args['tab_content_id'] : 'allcat_'.$uq ;
    }else{
        $_cat           = ( isset($tab_args['cat']) ) ? $tab_args['cat'] : $cat['0'] ;
        $_content_id    = ( isset($tab_args['tab_content_id']) ) ? $tab_args['tab_content_id'] : $_cat.'_'.$uq ;
    }
    $_orderby       = ( isset($tab_args['order']) ) ? $tab_args['order'] : $orderby ;
    
}
$_limit         = ( isset($tab_args['limit']) ) ? $tab_args['limit'] : $number_limit ;
$_class         = ( isset($tab_args['eclass']) ) ? ' item-animate '.$tab_args['eclass'] : '' ;
$_row           = ( isset($tab_args['row']) ) ? $tab_args['row'] : $number_row ;
$_gridstyle     = ( isset($tab_args['gridstyle']) ) ? $tab_args['gridstyle'] : $gridstyle ;
$_effect        = ( isset($tab_args['effect']) ) ? $tab_args['effect'] : $effect ;
$_template      = ( isset($tab_args['template']) ) ? $tab_args['template'] : $content_tab_template ;

if ( $_template == '2' ) {
    $_number_desktop         = ( isset($tab_args['number_desktop']) ) ? $tab_args['number_desktop'] : $number_desktop ;
    $_number_tablet          = ( isset($tab_args['number_tablet']) ) ? $tab_args['number_tablet'] : $number_tablet ;
    $_number_tabletp         = ( isset($tab_args['number_tabletp']) ) ? $tab_args['number_tabletp'] : $number_tabletp ;
    $_number_mobilel         = ( isset($tab_args['number_mobilel']) ) ? $tab_args['number_mobilel'] : $number_mobilel ;
    $_number_mobilep         = ( isset($tab_args['number_mobilep']) ) ? $tab_args['number_mobilep'] : $number_mobilep ;

    $_class .= ( !empty($_number_desktop) && $_number_desktop > 0 ) ? ' col-lg-' . 12/$_number_desktop : ' col-lg-2' ;
    $_class .= ( !empty($_number_tablet) && $_number_tablet > 0 ) ? ' col-md-' . 12/$_number_tablet : ' col-md-4' ;
    $_class .= ( !empty($_number_tabletp) && $_number_tabletp > 0 ) ? ' col-sm-' . 12/$_number_tabletp : ' col-sm-4' ;
    $_class .= ( !empty($_number_mobilel) && $_number_mobilel > 0 ) ? ' col-xs-' . 12/$_number_mobilel : ' col-xs-6' ;
    $_class .= ( !empty($_number_mobilep) && $_number_mobilep > 0 ) ? ' col-phone-' . 12/$_number_mobilep : ' col-phone-12' ;
    $_class = str_replace('.', '_', $_class);
    
    $loop = valen_woo_query($_orderby, $_row*$_number_desktop , $_cat);
}else{
    $loop = valen_woo_query($_orderby, $_limit, $_cat);
}

?>
<div id="<?php echo esc_attr( $_content_id ); ?>" class="prdlist-content grid-style<?php echo $_gridstyle; ?>">
<?php
if( $loop->have_posts() ) :
    ?>
    <div class="ajaxtab-products product_list grid style<?php echo $_gridstyle; ?> <?php if ( $_template == '1' ) echo 'owl-carousel'?> <?php echo $_effect; ?>" data-size="<?php echo ($loop->post_count/$_row); ?>">
        <?php
        $i = 0;
        while ( $loop->have_posts() ) : $loop->the_post();
            if ( $_row && $_row > 1 ){
                if ( $_template == '1' && ( $i == 0 || $i%$_row == 0 ) ) {
                    echo '<div class="item-row row-type-'.$_row.'">';
                }
            }
            wc_get_template( 'vc/item-grid.php', array('class' => $_class, 'gridstyle' => $_gridstyle) );
            if ( $_row && $_row > 1 ){
                if ( $_template == '1' && ( $loop->post_count == $i+1 || ($i+1)%$_row == 0 ) ) {
                    echo '</div><!--End .item-row-->';
                }
            }
            $i++;
        endwhile; ?>
    </div>
    <?php
    if ( $_template == '2' ){ ?>
        <div class="sns-woo-loadmore-wrap"><div id="sns_woo_loadmore_<?php echo $_content_id; ?>" class="sns-woo-loadmore btn"
            data-order="<?php echo $_orderby; ?>"
            data-cat="<?php echo $_cat; ?>"
            data-start="<?php echo $_row*$_number_desktop; ?>"
            data-loadtext="<?php echo esc_html__('Load more item'); ?>"
            data-loadingtext="<?php echo esc_html__('Loading...'); ?>"
            data-loadedtext="All ready"><?php echo esc_html__('Load more item'); ?></div></div>
    <?php 
    } ?>
<?php
else:
    echo '<p>'.esc_html__('There are no products matching to show', 'valen-shortcodes').'</p>';
endif;
wp_reset_postdata(); // Because valen_woo_query return WP_Query
?>
</div>