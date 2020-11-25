<?php
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    // This is your option name where all the Redux data is stored.
    $opt_name = "valen_themeoptions";
    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'            => esc_html__( 'Valen', 'valen' ),
        'page_title'            => esc_html__( 'Valen', 'valen' ),
        
        'dev_mode'             => false,
        'show_options_object'   => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        // OPTIONAL -> Give you extra features
        'page_priority'        => 50,
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'valen' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'valen' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'valen' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'valen' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'valen' );
    Redux::setHelpSidebar( $opt_name, $content );

    // Import Demo Content
    $desc = ''; 
    if ( !class_exists('WP_Importer') || !defined('WP_LOAD_IMPORTERS') ) {
        $subtitle = '
            <p><label><i class="fa fa-exclamation-circle"></i>  Please follow the check list bellow to enable import function:</label></p>
            <ul class="i_message">';
        if ( !class_exists('WP_Importer') ) {
            $subtitle .= '<li><i class="fa fa-angle-double-right"></i> Need install and active plugin <a href="'.esc_url("https://wordpress.org/plugins/wordpress-importer/").'" target="_blank">Wordpress Importer</a></li>';
        }
        if( !defined('WP_LOAD_IMPORTERS') ){
            $subtitle .= "<li><i class='fa fa-angle-double-right'></i> Need add <code>define('WP_LOAD_IMPORTERS', true);</code> to file wp-config.php</li>";
        }
        $subtitle .= '</ul>';
    }else{
        $subtitle = '<div class=\'button\' id=\'btn_sampledata\'>Import</div>';
        $subtitle .= '
            <div class=\'sns-importprocess\'>
                <div  class=\'sns-importprocess-width\'></div>
            </div>
            <span id=\'sns-importmsg\'><span class=\'status\'></span></span>
            <div id="sns-import-tablecontent">
                <label>List contents will import:</label>
                <ul>
                  <li class="theme-cfg"><i class="fa fa-hand-pointer-o"></i>Theme config</li>
                  <li class="revslider-cfg"><i class="fa fa-hand-pointer-o"></i>Revolution Slider config</li>
                  <li class="all-content"><i class="fa fa-hand-pointer-o"></i>All contents</li>
                  <li class="widget-cfg"><i class="fa fa-hand-pointer-o"></i>Widget config</li>
                  <li class="media1-files"><i class="fa fa-hand-pointer-o"></i>Media pack 1</li>
                  <li class="media2-files"><i class="fa fa-hand-pointer-o"></i>Media pack 2</li>
                  <li class="media3-files"><i class="fa fa-hand-pointer-o"></i>Media pack 3</li>
                </ul>
            </div>
        ';
    }
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-briefcase',
        'title' => esc_html__('Demo content', 'valen'),
        'fields' => array(
            array(
                'title' => '',
                'subtitle' => $subtitle,
                'desc'  => $desc,
                'id' => 'theme_data',
                'icon' => true,
                'type' => 'image_select',
                'default' => 'valen',
                'options' => array(
                    'sns_logo' => get_template_directory_uri().'/assets/img/logo.png',
                ),
            )
        )
    ) );
    // General
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'General', 'valen' ),
        'icon'      => 'el-icon-cog',
        'id'               => 'general',
        'customizer_width' => '400px'
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Color, Layout', 'valen' ),
        'id'               => 'general-layout',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'theme_color',
                'type'     => 'color',
                'output'   => array( '.site-title' ),
                'title'    => esc_html__( 'Theme Color', 'valen' ),
                'default'  => '#f4e206',
                'transparent'   => false
            ),
            array(
                'id'       => 'body_bg',
                'type'     => 'background',
                'output'   => array( 'body' ),
                'title'    => esc_html__( 'Body Background', 'valen' ),
                'background-image' => false,
                'preview'   => false,
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Fonts', 'valen' ),
        'id'               => 'general-font',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'          => 'body_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Body font', 'valen' ),
                'line-height'   => false,
                'text-align'   => false,
                'color'         => true,
                'all_styles'  => true,
                'units'       => 'px',
                'default'     => array(
                    'font-size'   => '14px',
                    'font-family' => 'Poppins',
                    'font-weight' => '400',
                    'color'       => '#666666'
                ),
            ),
            array(
                'id'          => 'headline_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Headline font', 'valen' ),
                'line-height'   => false,
                'text-align'    => false,
                'color'         => false,
                'font-size'     => false,
                'font-weight'   => false,
                'font-style'    => false,
                'all_styles'    => false,
                'units'         => 'px',
                'default'     => array(
                    'font-family' => '',
                ),
            ),
            array(
                'id'       => 'hfont_target',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Headline font target', 'valen' ),
                'default'  => ''
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Breadcrumbs', 'valen' ),
        'id'               => 'general-breadcrumb',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'showbreadcrump',
                'type'     => 'switch',
                'title'    => 'Show Breadcrumbs?',
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'breadcrumbbg',
                'type'     => 'media',
                'title'    => esc_html__("Want use Background image for Breadcrumbs?", 'valen'),
                'required' => array( 'showbreadcrump', '=', 1 ), 
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Header', 'valen' ),
        'icon'      => 'el el-brush',
        'fields'    => array(
            array(
                'id'       => 'header_style',
                'type' => 'select',
                'title'    => esc_html__( 'Header Style', 'valen' ),
                'default'  => 'style3',
                'options' => array(
                    'style1'        => esc_html__( 'Style1', 'valen'),
                    'style2'        => esc_html__( 'Style2', 'valen'),
                    'style3'        => esc_html__( 'Style3', 'valen'),
                    'style4'        => esc_html__( 'Style4', 'valen'),
                ),
                'desc'      => esc_html__( 'Select Header Style', 'valen' ),
            ),
            array(
                'id'       => 'mcat_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Style of menu category', 'valen' ),
                'default'  => '2',
                'options' => array(
                    '1'        => esc_html__( 'Big item', 'valen'),
                    '2'        => esc_html__( 'Inline icon', 'valen'),
                ),
                'required' => array( 'header_style', '=', array( 'style1') )
            ),
            array(
                'id'       => 'enable_search_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Search Category for Live Ajax Search', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'search_limit',
                'type'     => 'text',
                'title'    => esc_html__( 'Search limit numner', 'valen' ),
                'default'  => '12',
                'subtitle' => esc_html__( 'The number limit for search results dispplay', 'valen' ),
                'desc'     => esc_html__( 'Note: The value is number, and -1 is unlimit,', 'valen' ),
            ),
            array(
                'id'       => 'search_title_only',
                'type'     => 'switch',
                'title'    => esc_html__( 'Search by Title only', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'        => 'header_logo',
                'type'      => 'media',
                'default'   => '',
                'title'     => esc_html__( 'Logo', 'valen' ),
                'subtitle'  => esc_html__( 'If this is not selected, This theme will be display logo with "theme/valen/img/logo.png"', 'valen' ),
                'desc'      => esc_html__( 'Image that you want to use as logo', 'valen' ),
            ),
            array(
                'id'       => 'use_stickmenu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Sticky Menu', 'valen' ),
                'subtitle' => esc_html__( 'Keep menu on top when scroll down/up', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Footer', 'valen' ),
        'icon'      => 'el el-link',
        'fields'    => array(
            array(
                'title' => esc_html__( 'Style', 'valen'),
                'id' => 'footer_layout',
                'type'  => 'select',
                'multiselect' => false,
                'options' => array(
                    '1'      => esc_html__( 'Style 1', 'valen'),
                    '2'      => esc_html__( 'Style 2', 'valen'),
                    '3'      => esc_html__( 'Style 3', 'valen'),
                    '4'      => esc_html__( 'Style 4', 'valen'),
                    'blank'        => esc_html__( 'Blank', 'valen'),
                ),
                'default'  => '1'
            ), 
        )
    ));
    // Blog
    $siderbars = array(
        'widget-area' => esc_html__( 'Main Sidebar', 'valen' ),
        'product-sidebar' => esc_html__( 'Product Sidebar', 'valen' ),
        'blog-sidebar' => esc_html__( 'Blog Sidebar', 'valen' ),
        'woo-sidebar' => esc_html__( 'Woo Sidebar', 'valen' ),
    );
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Blog', 'valen' ),
        'icon'      => 'el el-file-edit',
        'id'               => 'blog',
        'customizer_width' => '400px'
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Pages', 'valen' ),
        'id'               => 'blog-page',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'layouttype',
                'type'     => 'image_select',
                'title'    => esc_html__('Default Blog Layout', 'valen'), 
                'options'  => array(
                    'm'      => array(
                        'alt'   => esc_html__( 'Without Sidebar', 'valen' ), 
                        'img'   => VALEN_THEME_URI.'/assets/img/admin/m.jpg'
                    ),
                    'l-m'      => array(
                        'alt'   => esc_html__( 'Use Left Sidebar', 'valen' ), 
                        'img'   => VALEN_THEME_URI.'/assets/img/admin/l-m.jpg'
                    ),
                    'm-r'      => array(
                        'alt'  => esc_html__( 'Use Right Sidebar', 'valen' ), 
                        'img'  => VALEN_THEME_URI.'/assets/img/admin/m-r.jpg'
                    ),
                ),
                'default' => 'm-r'
            ),
            // Left Sidebar
            array(
                'title'  => esc_html__( 'Left Sidebar', 'valen' ),
                'id'    => "leftsidebar",
                'type'  => 'select',
                'options'   => $siderbars,
                'multiselect'   => false,
                'required' => array( 'layouttype', '=', array( 'l-m', 'l-m-r' ) )
            ),
            // Right Sidebar
            array(
                'title'  => esc_html__( 'Right Sidebar', 'valen' ),
                'id'    => "rightsidebar",
                'type'  => 'select',
                'options'   => $siderbars,
                'multiselect'   => false,
                'required' => array( 'layouttype', '=', array( 'm-r', 'l-m-r' ) )
            ),
            array( 
                'title' => esc_html__( 'Blog Style', 'valen'),
                'id' => 'blog_type',
                'default' => 'layout1',
                'type' => 'select',
                'multiselect' => false ,
                'options' => array(
                    'layout1'       => esc_html__( 'Blog Default', 'valen'),
                    'layout2'       => esc_html__( 'Blog List ', 'valen'),
                )
            ),
            array(
                'id'        => 'pagination',
                'title'     => esc_html__( 'Page Navigation', 'valen'),
                'desc'      => esc_html__('Choose Type of navigation for blog and any listing page.', 'valen'),
                'default'   => 'def',
                'type'      => 'select',
                'multiselect' => false ,
                'options'   => array(
                    'def'   => esc_html__('Default', 'valen'),
                    'ajax'  =>  esc_html__('Ajax click load more', 'valen'),
                    'ajax2'  =>  esc_html__('Ajax auto load more', 'valen'),
                ),
            ),
            array(
                'id'       => 'masonry_numload',
                'type'     => 'text',
                'title'    => esc_html__( 'Number post with each load more', 'valen' ),
                'default'  => '3',
                'required' => array( 'pagination', '=', array( 'ajax', 'ajax2' ) )
            ),
            array(
                'id'       => 'show_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Categories for Blog Entries Page', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'show_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Date for Blog Entries Page', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            
            array(
                'id'       => 'show_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Author for Blog Entries Page', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'show_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Tags for Blog Entries Page', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'show_comment_count',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Comment Count', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'excerpt_length',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog Excerpt Length', 'valen' ),
                'default'  => '75',
            ),
            array(
                'id'       => 'show_morelink',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show more link', 'valen' ),
                'subtitle' => esc_html__( 'Apply when post have Excerpt', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Single Post', 'valen' ),
        'id'               => 'blog-singlepost',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'show_postauthor',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Author Info on Post Detail', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'show_postsharebox',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Share box', 'valen' ),
                'subtitle' => esc_html__( 'Just work when you install plugin Simple Share Buttons Adder', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
        )
    ));
    // WooCommerce
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Woo', 'valen' ),
        'icon'      => 'el el-shopping-cart',
        'id'               => 'woo',
        'desc'             => __( 'These are really basic fields!', 'valen' ),
        'customizer_width' => '400px'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Archives Pages', 'valen' ),
        'id'               => 'woo-shoppage',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'woo_uselazyload',
                'type'     => 'switch',
                'title'    => esc_html__( 'Use lazyload for Product Image', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_stickypfilter',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky product filter in left', 'valen' ),
                'subtitle'  => esc_html__( 'To use this option you need add Widgets for sidebar Woo Sidebar - Sticky', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'        => 'woo_list_modeview',
                'type'      => 'select',
                'title'     => esc_html__( 'Default mode view for archives page', 'valen' ),
                'options'  => array(
                    'grid' => esc_html__( 'Grid', 'valen' ),
                    'list' => esc_html__( 'List', 'valen' ),
                ),
                'default'  => 'grid'
            ),
            array(
                'id'        => 'woo_gridstyle',
                'type'      => 'select',
                'title'     => esc_html__( 'Grid style', 'valen' ),
                'options'  => array(
                    ''  => esc_html__( 'Style 1', 'valen' ),
                    '2' => esc_html__( 'Style 2', 'valen' ),
                    '3' => esc_html__( 'Style 3', 'valen' ),
                    '4' => esc_html__( 'Style 4', 'valen' ),
                ),
                'default'  => ''
            ),
            array(
                'id'       => 'woo_grid_col',
                'type'     => 'select',
                'title'    => esc_html__( 'Default Grid columns', 'valen' ),
                'subtitle'  => esc_html__( 'We are using grid bootstap - 12 cols layout', 'valen' ),
                'default'  => '3',
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ),
            ),
            array(
                'id'       => 'woo_number_perpage',
                'type'     => 'text',
                'title'    => esc_html__( 'Number products per listing page', 'valen' ),
                'default'  => '12',
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Single Product', 'valen' ),
        'id'               => 'woo-singleproduct',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'woo_usecloudzoom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Image Zoom', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_usezoommobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Image Zoom on Mobile', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
                'required' => array( 'woo_usecloudzoom', '=', true )
            ),
            array(
                'id'       => 'woo_zoomtype',
                'type'     => 'select',  
                'title'    => esc_html__( 'Zoom Type for Cloud Zoom', 'valen' ),
                'options'  => array(
                    'lens'      => esc_html__( 'Lens', 'valen' ),
                    'inner'     => esc_html__( 'Inner', 'valen' ),                                             
                ),
                'default'  => 'lens',       
                'required' => array( 'woo_usecloudzoom', '=', true )    
            ),
            array(
                'id'       => 'woo_lensshape',
                'type'     => 'select',  
                'title'    => esc_html__( 'Lens Shape', 'valen' ),
                'options'  => array(
                    'round'     => esc_html__( 'Round', 'valen' ),
                    'square'    => esc_html__( 'Square', 'valen' ),                                            
                ),
                'default'  => 'round',       
                'required' => array( 'woo_zoomtype', '=', 'lens' )  
            ),
            array(
                'id'       => 'woo_lenssize',
                'type'     => 'text',  
                'title'    => esc_html__( 'Lens Size', 'valen' ),
                'default'  => '200',       
                'required' => array( 'woo_zoomtype', '=', 'lens' )  
            ),
            array(
                'id'       => 'woo_usepopupimage',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Popup Image', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_usethumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Thumbnail', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_gallery_type',
                'type'     => 'select',  
                'title'    => esc_html__( 'Gallery Thumbnail Type', 'valen' ),
                'default'  => 'h',
                'options'  => array(
                    'h'     => esc_html__( 'Horizontal', 'valen' ),
                    'v'      => esc_html__( 'Vertical', 'valen' ),
                    'n1'      => esc_html__( 'None - Use scrolling layout', 'valen' ),
                ),
                'required' => array( 'woo_usethumb', '=', '1' )
            ),
            array(
                'id'       => 'woo_thumb_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Number Thumbnail to display', 'valen' ),
                'required' => array( 'woo_usethumb', '=', '1' ),
                'default'  => '4',
            ),
            array(
                'id'       => 'single_product_sidebar',
                'type'     => 'switch',
                'title'    => esc_html__( 'Use Sidebar in Single Product Page', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_designvariations',
                'type'     => 'switch',
                'title'    => esc_html__( 'Re-design Variations Form', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_sharebox',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Share box', 'valen' ),
                'subtitle' => esc_html__( 'Just work when you install plugin Simple Share Buttons Adder', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_upsells',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Upsells Products', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_upsells_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Number limit of Upsells Products', 'valen' ),
                'required' => array( 'woo_upsells', '=', '1' ),
                'default'  => '6',
            ),
            array(
                'id'       => 'woo_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Related Products', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'woo_related_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Number limit of Related Products', 'valen' ),
                'required' => array( 'woo_related', '=', '1' ),
                'default'  => '6',
            ),
        )
    ));
    // Not Found
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Page Not Found', 'valen' ),
        'icon'      => 'el el-warning-sign',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'bg_404',
                'type'     => 'media',
                'title'    => esc_html__("Image for 404 not found page", 'valen'),
            ),
            array(
                'id'       => 'notfound_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Title', 'valen' ),
                'default'  => esc_html__('Opps! This Page Could Not Be Found!', 'valen'),
            ),
            array(
                'id'       => 'notfound_content',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Message Content', 'valen' ),
                'default'  => esc_html__('Sorry bit the page you are looking for does not exist, have been removed or name changed', 'valen'),
            ),
        )
    ));
    // Advance
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Advance', 'valen' ),
        'icon'      => 'el el-wrench',
        'fields'    => array(
            array(
                'id'       => 'advance_tooltip',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Tooltip', 'valen' ),
                'default'  => false,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'advance_cpanel',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Cpanel', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'       => 'tf_p_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Link to purchase theme', 'valen' ),
                'default'  => esc_html__('https://1.envato.market/c/1267228/275988/4415?subId1=from_demo&u=https%3A%2F%2Fthemeforest.net%2Fitem%2Fvalen-sport-fashion-woocommerce-wordpress-theme%2F22922379', 'valen'),
                'required' => array( 'advance_cpanel', '=', '1' )
            ),
            array(
                'id'       => 'advance_scrolltotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Button Scroll To Top', 'valen' ),
                'default'  => true,
                'on'       => 'Yes',
                'off'      => 'No',
            ),
            array(
                'id'        => 'advance_scss_compile',
                'type'      => 'select',
                'title'     => esc_html__( 'SCSS Compile', 'valen' ),
                'options'  => array(
                    '1' => esc_html__( 'Only compile when don\'t have the css file', 'valen' ),
                    '2' => esc_html__( 'Alway compile', 'valen' ),
                ),
                'default'  => '1'
            ),
            array(
                'id'        => 'advance_scss_format',
                'type'      => 'select',
                'title'     => esc_html__( 'CSS Format', 'valen' ),
                'options'  => array(
                    'scss_formatter' => esc_html__( 'scss_formatter', 'valen' ),
                    'scss_formatter_nested' => esc_html__( 'scss_formatter_nested', 'valen' ),
                    'scss_formatter_compressed' => esc_html__( 'scss_formatter_compressed', 'valen' ),
                ),
                'default'  => 'scss_formatter'
            ),
        )
    ));


