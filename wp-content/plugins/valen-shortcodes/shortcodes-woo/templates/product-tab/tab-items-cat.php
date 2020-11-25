<!-- Tabs to click ajax -->
<ul class="nav-tabs hidden-sm hidden-xs">
<?php
if ( $show_tab_all == '1' ) { ?>
<li class="cat-allcat second-font">
	<a href="#allcat_<?php echo $uq; ?>" data-toggle="tab" data-cat=""><?php echo esc_html__('All', 'valen-shortcodes'); ?>
		<?php 
		if( $show_cat_number == 1 ) { 
			$cat = '';
			if ( $cat_tab != '' ) {
				$cat = $cat_tab;
			}
			$loop = valen_woo_query('recent', -1 , $cat);
			echo '<span class="cat-number">'.$loop->post_count.'</span>';
			wp_reset_postdata();
		}
		?>
	</a>
</li>
<?php
}
$tabs = explode(',', $cat_tab);
foreach ( $tabs as $tab ) :
	$cat = get_term_by('slug', $tab, 'product_cat'); ?>
	<li class="cat-<?php echo esc_attr( $tab ); ?> second-font">
		<a href="#<?php echo esc_attr( $tab ).'_'.$uq; ?>" data-toggle="tab" data-cat="<?php echo esc_attr( $tab ); ?>"><?php echo $cat->name; ?>
			<?php 
			if( $show_cat_number == 1) { echo '<span class="cat-number">'.$cat->count.'</span>';}
			?>
		</a>
	</li>
<?php
endforeach; ?>
</ul>
<ul class="tab-drop-nav">
    <li class="dropdown pull-right tabdrop hidden-lg hidden-md">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle ion-navicon"></a>
        <ul class="dropdown-menu">
        	<?php
			if ( $show_tab_all == '1' ) { ?>
			<li class="cat-allcat">
				<a href="#allcat_<?php echo $uq; ?>" data-toggle="tab" data-cat=""><?php echo esc_html__('All', 'valen-shortcodes'); ?></a>
			</li>
			<?php
			}
            foreach ( $tabs as $tab ) :
				$cat = get_term_by('slug', $tab, 'product_cat'); ?>
				<li class="cat-<?php echo esc_attr( $tab ); ?>">
					<a href="#<?php echo esc_attr( $tab ).'_'.$uq; ?>" data-toggle="tab" data-cat="<?php echo esc_attr( $tab ); ?>"><?php echo $cat->name; ?></a>
				</li>
			<?php
			endforeach; ?>
        </ul>
    </li>
</ul>