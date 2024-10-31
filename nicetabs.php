<?php
/*
Plugin Name: niceTabs
Plugin URI: http://27thisland.com/nicetabs
Description: Create jQuery-based Tabs in a post
Version: 1.0
Author: Arief Rachmansyah
Author URI: http://ariefsyu.com
License: GPL
*/


function TitleTab($atts, $content = null) {
	extract(
		shortcode_atts(
			array(
				'tab_id' => 'tab1',
				'tab_title' => 'Tab One'
			), $atts
		)
	);
	$tabsID = explode(',', $tab_id);
	$tabsTitle = explode(',', $tab_title);
	$html = '<ul class="tabs">';
	foreach($tabsID as $key => $val){
		$html .= '<li><a href="#' . $val .'">'.$tabsTitle[$key].'</a></li>';
	}
	$html .= '</ul>';
	
	return $html;
}
function StartTab($atts, $content = null) {	
	$html = '<div class="tab_container">';	
	return $html;
}
function EndTab($atts, $content = null) {	
	$html = '</div>';	
	return $html;
}
function ContentTab($atts, $content = null) {
	extract(
		shortcode_atts(
			array(
				'id' => 'tab1'
			), $atts
		)
	);
	$html = '<div class="tab_content" id="'.$id.'">';
	$html .= $content;
	$html .= '</div>';
	
	return $html;
}
add_shortcode("tTab", "TitleTab");
add_shortcode("sTab", "StartTab");
add_shortcode("eTab", "EndTab");
add_shortcode("cTab", "ContentTab");

add_action('wp_head','niceTabs_addCSS');
add_action('wp_print_scripts','niceTabs_addJS');

function niceTabs_addCSS(){
	echo "<link rel='stylesheet' id='niceTabs-css' type='text/css' media='all' href='". WP_CONTENT_URL . "/plugins/niceTabs/style.css'; />";
}

function niceTabs_addJS() {
       wp_enqueue_script('googlejquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js'); 
       wp_enqueue_script('niceTabs', WP_CONTENT_URL . '/plugins/niceTabs/niceTabs.js'); 
}

?>
