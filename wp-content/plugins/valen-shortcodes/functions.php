<?php 
function valen_shortcode_template( $name = false ) {
    if (!$name)
        return false;
    if ( $overridden_template = locate_template( 'vc_templates/' . $name . '.php' ) ) {
        return $overridden_template;
    } else {
        return VALEN_SHORTCODES_PATH . '/shortcodes/templates/' . $name . '.php';
    }
}
function valen_shortcode_woo_template( $name = false ) {
    if (!$name)
        return false;
    if ( $overridden_template = locate_template( 'vc_templates/' . $name . '.php' ) ) {
        return $overridden_template;
    } else {
        return VALEN_SHORTCODES_PATH . '/shortcodes-woo/templates/' . $name . '.php';
    }
}
function valen_extra_class(){
    return array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", 'valen-shortcodes'),
            "param_name" => "extra_class"
        );
}
function valen_getCSSAnimation( $css_animation ) {
    $output = '';
    if ( '' !== $css_animation && 'none' !== $css_animation ) {
        wp_enqueue_script( 'waypoints' );
        wp_enqueue_style( 'animate-css' );
        $output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
    }

    return $output;
}
function valen_css_animation(){
    return array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'CSS Animation', 'valen-shortcodes' ),
        'param_name' => 'css_animation',
        'admin_label' => true,
        'value' => array(
            esc_html__( 'No', 'valen-shortcodes' ) => '',
            esc_html__( 'Top to bottom', 'valen-shortcodes' ) => 'top-to-bottom',
            esc_html__( 'Bottom to top', 'valen-shortcodes' ) => 'bottom-to-top',
            esc_html__( 'Left to right', 'valen-shortcodes' ) => 'left-to-right',
            esc_html__( 'Right to left', 'valen-shortcodes' ) => 'right-to-left',
            esc_html__( 'Appear from center', 'valen-shortcodes' ) => 'appear'
        ),
        'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'valen-shortcodes' )
    );
}
function valen_woo_cat_level( $parent_id, $pos, $array, $level, &$dropdown ) {
    for ( $i = $pos; $i < count( $array ); $i ++ ) {
        if ( $array[ $i ]->category_parent == $parent_id ) {
            $name = str_repeat( '- ', $level ) . $array[ $i ]->name;
            $value = $array[ $i ]->slug;
            $dropdown[] = array(
                'label' => $name,
                'value' => $value,
            );
            valen_woo_cat_level( $array[ $i ]->term_id, $i, $array, $level + 1, $dropdown );
        }
    }
}
function valen_woo_cat($bool =1) {
    $args = array(
            'type' => 'post',
            'child_of' => 0,
            'parent' => '',
            //'orderby' => 'parent_id',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'number' => '',
            'taxonomy' => 'product_cat',
            'pad_counts' => false,

        );
    $categories = get_categories( $args );
    if ($bool==0) return $categories;
    $dropdown = array(); $woocat_value = array(); 
    valen_sort_level_catid(0, $categories, 0 , $dropdown);
    foreach ($dropdown as $cat) {
        $woocat_value[$cat['label']] = $cat['value'];
    }
    return $woocat_value;
}
function valen_sort_level_catid( $parent_id, $array, $level, &$dropdown){
    $keys = array_keys( $array );
    $i = 0;
    while ( $i < count( $array ) ) {
        $key = $keys[ $i ];
        $item = $array[ $key ];
        $i ++;
        if ( $item->category_parent == $parent_id ) {
            $name = str_repeat( '- ', $level ) . $item->name;
            $value = $item->slug;
            $dropdown[] = array(
                'label' => $name . '(id:' . $item->term_id . ')',
                'value' => $value,
            );
            //$dropdown[$name] = $value;
            unset( $array[ $key ] );
            $array = valen_sort_level_catid( $item->term_id, $array, $level + 1, $dropdown );
            $keys = array_keys( $array );
            $i = 0;
        }
    }

    return $array;
}
function valen_cat(){
    global $wpdb;
    $sql = $wpdb->prepare( "
        SELECT a.name,a.slug,a.term_id 
        FROM {$wpdb->terms} a JOIN  {$wpdb->term_taxonomy} b ON (a.term_id= b.term_id ) 
        WHERE b.count> %d and b.taxonomy = %s",
        0,'category' );
    $results = $wpdb->get_results($sql);
    $cat_value = array();
    foreach ($results as $cat) {
        $cat_value[$cat->name] = $cat->slug;
    }
    return $cat_value;
}
function valen_woo_tags_array(){
    $args = array(
        'taxonomy' => 'product_tag',
        'number' => 10000,
        'format' => 'array',
    );
    $tags = get_terms( $args['taxonomy'], $args ); // Always query top tags
    $tags_arr = array();
    foreach ($tags as $key => $value) {
        $tags_arr[$value->name]  = $value->term_id;
    }
    return $tags_arr;
}
function valen_ajaxtab_order_title($tab){
    switch ($tab) {
        case 'recent':
            return array('name'=>$tab,'title'=>esc_html__('Latest Products','valen-shortcodes'),'short_title'=>esc_html__('Latest','valen-shortcodes'));
        case 'featured_product':
            return array('name'=>$tab,'title'=>esc_html__('Featured','valen-shortcodes'),'short_title'=>esc_html__('Featured','valen-shortcodes'));
        case 'top_rate':
            return array('name'=>$tab,'title'=> esc_html__('Top Rated','valen-shortcodes'),'short_title'=>esc_html__('Top Rated', 'valen-shortcodes'));
        case 'best_selling':
            return array('name'=>$tab,'title'=>esc_html__('Best Seller','valen-shortcodes'),'short_title'=>esc_html__('Best Seller','valen-shortcodes'));
        case 'on_sale':
            return array('name'=>$tab,'title'=>esc_html__('Sale off','valen-shortcodes'),'short_title'=>esc_html__('Sale','valen-shortcodes'));
    }
}

add_filter( 'vc_iconpicker-type-flaticon', 'vc_iconpicker_type_flaticon' );
function vc_iconpicker_type_flaticon( $icons ) {
    $icon_flat = array(); $flaticon_icons = array();
    $content_flat = '';
    if( file_exists( get_template_directory().'/assets/fonts/valen-flaticon/font/flaticon.css' ) ) {
        $content_flat = file_get_contents(get_template_directory().'/assets/fonts/valen-flaticon/font/flaticon.css');
    }
    preg_match_all('/\.(flaticon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/', $content_flat , $matches_flat, PREG_SET_ORDER);
    foreach($matches_flat as $k => $v){
       $icon_flat[$k] = $v[1];
    }
    if( is_array($icon_flat ) && !empty($icon_flat)) {
        foreach( $icon_flat as $k => $v) { 
            $flaticon_icons[] = array( $v => $v );
        }
    }
    return array_merge( $icons, $flaticon_icons );
}
add_action('admin_enqueue_scripts', 'valen_admin_flaticon_scripts');
function valen_admin_flaticon_scripts(){
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/valen-flaticon/font/flaticon.css');
}


