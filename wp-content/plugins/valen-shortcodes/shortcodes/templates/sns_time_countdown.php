<?php
$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( 'sns_time_countdown', $atts );
extract( $atts );
// Set date to default 12 days for http://demo.snstheme.com/
$current_date = date("Y/m/d");
if($_SERVER['SERVER_NAME'] == 'demo.snstheme.com' || $_SERVER['SERVER_NAME'] == 'dev.snsgroup.me' ){
	if($thedate == 0 || empty($thedate) || $thedate < $current_date)
		$thedate = date('Y/m/d', strtotime('+13 days'));
}
if($thedate == ''){
	return;
}
wp_enqueue_script('jquery-countdown');
$class = 'sns-time-countdown';
if ($style) $class .= ' '.esc_attr($style);
$class .= ' '.esc_attr( valen_getCSSAnimation( $css_animation ) );
if ($extra_class) $class .= ' '.esc_attr($extra_class);
ob_start();
?>
<div class="time-count-down <?php echo $class; ?>" id="sns-tcd-<?php echo $id; ?>" data-date="<?php echo $thedate; ?>">
<div class="clock-digi">
    <div><div><div class="day"></div><?php esc_html_e('Days', 'valen');?></div></div>
    <div><div><div class="hours"></div><?php esc_html_e('Hours', 'valen');?></div></div>
    <div><div><div class="minutes"></div><?php esc_html_e('Mins', 'valen');?></div></div>
    <div><div><div class="seconds"></div><?php esc_html_e('Secs', 'valen');?></div></div>
</div>
</div>
<?php
$output = ob_get_clean();
echo $output;