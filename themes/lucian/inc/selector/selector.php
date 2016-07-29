<?php 
function zo_presets_selector_scripts(){

	wp_enqueue_script('zo-jquery-cookie', get_template_directory_uri()  . '/inc/selector/js/jquery_cookie.min.js', array( 'jquery' ), '1.4.0', true);
	wp_localize_script('zo-jquery-cookie', 'ZOPreset', array('theme_url' => get_template_directory_uri()) );
	wp_enqueue_script('zo-selector-script', get_template_directory_uri() . '/inc/selector/js/presets.js', array( 'jquery' ), '1.4.0', true);
	wp_enqueue_style('zo-selector-style', get_template_directory_uri() . '/inc/selector/css/presets.css');
}
add_action( 'wp_enqueue_scripts', 'zo_presets_selector_scripts' );

function zo_presets_selector() {
	global $smof_data, $zo_meta;
	
	$presets_color = $smof_data['presets_color'];
	if(isset($zo_meta->_zo_presets_color) && $zo_meta->_zo_presets_color){
		$presets_color = $zo_meta->_zo_presets_color;
	}
	
	$body_layout = $smof_data['body_layout'];
	if (isset($_COOKIE['body_layout'])) {
		$body_layout = $_COOKIE['body_layout'];
	}
	
	$bg_body_layout_boxed = '';
	if( $body_layout == 1 && !empty($smof_data['body_layout']) ) 
		$bg_body_layout_boxed = $smof_data['body_layout'];
	if (isset($_COOKIE['bg_body_layout_boxed'])) {
		$bg_body_layout_boxed = $_COOKIE['bg_body_layout_boxed'];
	}
	
	$arr_color = array(
		'0' => '#ff83a6', '1' => '#b99937', '2' => '#5ab7d6', '3' => '#5c71a1', '4' => '#4cb5b6', 
	);
?>
<div id="style_selector">
	<div class="style-toggle close" style="background: <?php echo esc_attr($arr_color[$presets_color]);?>;"><i class="fa fa-2x fa-spin fa-cog"></i></div>
	<div id="style_selector_container">
        <div class="box-title"><?php esc_html_e('Predefined Color Schemes', 'lucian'); ?></div>
        <div class="predefined">
            <a href="javascript:void(0);" class="preset0 <?php echo ($presets_color=='0')?'active':'';?>" id="0" data-color="#ff83a6"></a>								
            <a href="javascript:void(0);" class="preset1 <?php echo ($presets_color=='1')?'active':'';?>" id="1" data-color="#b99937"></a>								
            <a href="javascript:void(0);" class="preset2 <?php echo ($presets_color=='2')?'active':'';?>" id="2" data-color="#5ab7d6"></a>								
            <a href="javascript:void(0);" class="preset3 <?php echo ($presets_color=='3')?'active':'';?>" id="3" data-color="#5c71a1"></a>					
            <a href="javascript:void(0);" class="preset4 <?php echo ($presets_color=='4')?'active':'';?>" id="4" data-color="#4cb5b6"></a>					
        </div>
	    <div class="box-title"><?php esc_html_e('Choose Your Layout Style', 'lucian'); ?></div>
	    <div class="input-box">
		    <div class="input">
			    <select name="layout" class="layout">
				    <option value="0" <?php if( $body_layout == 0 ) echo "selected"; ?>><?php esc_html_e('Wide', 'lucian'); ?></option>
				    <option  value="1" <?php if( $body_layout == 1 ) echo "selected"; ?>><?php esc_html_e('Boxed', 'lucian'); ?></option>
			    </select>
		    </div>
	    </div>
		<div class="box-title"><?php esc_html_e('BG Patterns for Boxed', 'lucian');?></div>
		<div class="pattern">
			<a href="javascript:void(0);" class="pattern0 <?php if($bg_body_layout_boxed == 1) echo 'active';?>" name="1"></a>								
			<a href="javascript:void(0);" class="pattern1 <?php if($bg_body_layout_boxed == 2) echo 'active';?>" name="2"></a>								
			<a href="javascript:void(0);" class="pattern2 <?php if($bg_body_layout_boxed == 3) echo 'active';?>" name="3"></a>								
			<a href="javascript:void(0);" class="pattern3 <?php if($bg_body_layout_boxed == 4) echo 'active';?>" name="4"></a>								
			<a href="javascript:void(0);" class="pattern4 <?php if($bg_body_layout_boxed == 5) echo 'active';?>" name="5"></a>								
			<a href="javascript:void(0);" class="pattern5 <?php if($bg_body_layout_boxed == 6) echo 'active';?>" name="6"></a>								
			<a href="javascript:void(0);" class="pattern6 <?php if($bg_body_layout_boxed == 7) echo 'active';?>" name="7"></a>								
			<a href="javascript:void(0);" class="pattern7 <?php if($bg_body_layout_boxed == 8) echo 'active';?>" name="8"></a>								
			<a href="javascript:void(0);" class="pattern8 <?php if($bg_body_layout_boxed == 9) echo 'active';?>" name="9"></a>								
			<a href="javascript:void(0);" class="pattern9 <?php if($bg_body_layout_boxed == 10) echo 'active';?>" name="10"></a>								
		</div>
    </div>
</div>
<?php 
}
?>