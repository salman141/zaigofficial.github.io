<!-- Tabs to click ajax -->
<ul class="nav-tabs hidden-sm hidden-xs">
<?php
$tabs = explode(',', $orderby_tab);
foreach ( $tabs as $tab ) :
	$tab = valen_ajaxtab_order_title($tab); ?>
	<li class="<?php echo esc_attr( $tab['name'] ); ?>">
		<a href="#<?php echo esc_attr( $tab['name'] ).'_'.$uq; ?>" data-toggle="tab" data-order="<?php echo esc_attr( $tab['name'] ); ?>"><?php echo $tab['title']; ?></a>
	</li>
<?php
endforeach; ?>
</ul>
<ul class="tab-drop-nav">
    <li class="dropdown pull-right tabdrop hidden-lg hidden-md">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle ion-navicon"></a>
        <ul class="dropdown-menu">
            <?php
            foreach ( $tabs as $tab ) :
				$tab = valen_ajaxtab_order_title($tab); ?>
				<li class="<?php echo esc_attr( $tab['name'] ); ?>">
					<a href="#<?php echo esc_attr( $tab['name'] ).'_'.$uq; ?>" data-toggle="tab" data-order="<?php echo esc_attr( $tab['name'] ); ?>"><?php echo $tab['title']; ?></a>
				</li>
			<?php
			endforeach; ?>
        </ul>
    </li>
</ul>