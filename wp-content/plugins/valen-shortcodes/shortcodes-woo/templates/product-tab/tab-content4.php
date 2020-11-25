<?php
// Carousel - Special template 2
$_tab_type       = ( isset($tab_args['tab_type']) ) ? $tab_args['tab_type'] : $tab_type ;
if ( $image_tabcontent ) {
    $ico_cats = explode(',', $image_tabcontent);
    if ( $_tab_type == 1 ) {
        $tabs = explode(',', $orderby_tab);
    }else {
        $tabs = explode(',', $cat_tab);
        //allcat
    }
    $i=0;
    ?>
    <div class="hidden">
        <?php
        foreach ($tabs as $tab):
            if ( isset( $ico_cats[$i] ) ) {
                echo '<div class="img-info ' . $tab . '_' . $uq . '" data-img="' .wp_get_attachment_url($ico_cats[$i]).'"></div>';
            }
            $i++;
        endforeach;
        ?>
    </div>
    <?php
}
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

$loop = valen_woo_query($_orderby, $_limit, $_cat);

?>
<div id="<?php echo esc_attr( $_content_id ); ?>" class="prdlist-content grid-style<?php echo $_gridstyle; ?>">
    <?php
    $cat_info = get_term_by('slug', $_cat, 'product_cat'); 
    if ( $cat_info != false ) {
        echo '<a class="banner-link" href="'.get_term_link($_cat, 'product_cat').'">';
        if ( isset($ico_cats) && is_array($ico_cats) && isset( $ico_cats['0'] ) ) {
            echo '<img src="' .wp_get_attachment_url($ico_cats['0']).'" alt="'.$cat_info->name.'"/>';
        }
        echo '</a>';
    }
    ?>
<?php
if( $loop->have_posts() ) :
    ?>
    <div class="ajaxtab-products product_list grid style<?php echo $_gridstyle; ?> owl-carousel <?php echo $_effect; ?>" data-size="<?php echo ($loop->post_count/$_row); ?>">
        <?php
        $i = 0;
        while ( $loop->have_posts() ) : $loop->the_post();
            if ( $i == 0 || $i%$_row == 0 ) {
                echo '<div class="item-row row-type-'.$_row.'">';
            }
            wc_get_template( 'vc/item-grid.php', array('class' => $_class, 'gridstyle' => $_gridstyle) );
            if ( $loop->post_count == $i+1 || ($i+1)%$_row == 0 ) {
                echo '</div><!--End .item-row-->';
            }
            $i++;
        endwhile; ?>
    </div>
<?php
else:
    echo '<p>'.esc_html__('There are no products matching to show', 'valen-shortcodes').'</p>';
endif;
wp_reset_postdata(); // Because valen_woo_query return WP_Query
?>
</div>