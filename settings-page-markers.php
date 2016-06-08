<?php

if (is_admin()) {
  add_action('admin_menu', 'mf_map_filter_menu');
  add_action('admin_init', 'mf_map_filter_register_settings');
}

function mf_map_filter_menu() {
	add_options_page('Map Marker Settings','Map Marker Settings','manage_options','mf_map_filter_settings','mf_map_filter_settings_view');
}

function mf_map_filter_settings() {
	$map_filter = array();
	$map_filter[] = array('name'=>'mf_map_filter_maptype','label'=>'Map Type','value'=>'ROADMAP/ SATELLITE / HYBRID / TERRAIN ');
	$map_filter[] = array('name'=>'mf_map_filter_initial_latitude','label'=>' Latitude','value'=>'0');
	$map_filter[] = array('name'=>'mf_map_filter_initial_longitude','label'=>' Longitude','value'=>'0');
	$map_filter[] = array('name'=>'mf_map_filter_height','label'=>'Map Height','value'=>'500');
	$map_filter[] = array('name'=>'mf_map_filter_width','label'=>'Map Width','value'=>'500');
	$map_filter[] = array('name'=>'mf_map_filter_zoom','label'=>'Map Zoom','value'=>'1');
	return $map_filter;
}

function mf_map_filter_register_settings() {
	$settings = mf_map_filter_settings();
	foreach($settings as $setting) {
		register_setting('mf_map_filter_settings',$setting['name']);
	}
}
// Settings page display
function mf_map_filter_settings_view() {
	$settings = mf_map_filter_settings();
	
	echo '<div class="wrap">';
	
		echo '<h2>Map Marker Settings</h2>';
		echo '<form method="post" action="options.php">';
		
    settings_fields('mf_map_filter_settings');
		
		echo '<table>';
			foreach($settings as $setting) {
					echo '<tr>';
					echo '<td>'.$setting['label'].'</td>';
					echo '<td><input type="text" value="'.get_option($setting['name']).'"  placeholder="'.$setting['value'].'" style="width: 400px" name="'.$setting['name'].'"  /></td>';
				echo '</tr>';
			}
		echo '</table>';
		
		submit_button();
		
		echo '</form>';
		
		echo '<hr />';
	echo '</div>';
	}