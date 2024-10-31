<?php
/*
Plugin Name:  Printer-Friendly WP
Plugin URI:   http://www.royaldeerdesign.com/wordpress-plugin-printer-friendly-wp
Description:  This plugin adds an icon to all posts which links to Print-Friendly page with a content of the post. This plugin is very simple to use and very easy to modify, so with a little bit of coding skills you can customize a look of the Print-Friendly page.
Version:      0.0.4
Author:       royaldeerdesign.com
Author URI:   http://www.royaldeerdesign.com
Contributors: Daniel Sodkiewicz

Copyright (C) 2013, Royal Deer Design
All rights reserved.

*/


if ( is_admin() ) {

	add_action('admin_menu', 'show_print_button_options');
	function show_print_button_options() {
    
	// Adding a new submenu
 
	add_options_page('Printer-Friendly WP Options', 'Printer-Friendly WP', 'manage_options', 'print_postpage_comments', 'print_button_options');

	//Add options
	
	add_option('print_button_posts', 'on');
	add_option('print_button_pages', 'off');

}

//
// Admin
//

function print_button_options() { ?>
<style type="text/css">
	div.headerWrap { background-color:#e4f2fds; width:200px}
	#options h3 { padding:7px; padding-top:10px; margin:0px; cursor:auto }
	#options label { width: 300px; float: left; margin-left: 10px; }
	#options input { float: left; margin-left:10px}
	#options p { clear: both; padding-bottom:10px; }
	#options .postbox { margin:0px 0px 10px 0px; padding:0px; }
</style>
<div class="wrap">
<form method="post" action="options.php" id="options">
<?php wp_nonce_field('update-options') ?>
<h2>Printer-Friendly WP</h2>

<div class="postbox-container" style="width:100%;">

	<div class="metabox-holder" style="float: left;width:100%;">
	<div class="postbox">
		<h3 class="hndle"><span>Settings</span></h3>
		<div style="margin:20px;">
		<p>
			<?php
				if (get_option('print_button_posts') == 'on') {echo '<input type="checkbox" name="print_button_posts" checked="yes" />';}
				else {echo '<input type="checkbox" name="print_button_posts" />';}
			?>
			<label>Show button in all single posts</label>
	</p>
		<p>
			<?php
				if (get_option('print_button_pages') == 'on') {echo '<input type="checkbox" name="print_button_pages" checked="yes" />';}
				else {echo '<input type="checkbox" name="print_button_pages" />';}
			?>
			<label>Show button on all pages</label>
		</p>
		
<br />
<br />

</div>
</div>
</div>
</div>
	<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="print_button_posts,print_button_pages" />
<div class="submit"><input type="submit" class="button-primary" name="submit" value="Save"></div>

</form>
</div>
<?php 
add_action( 'init', 'print_button_options' );
}
}else{
?>
<?php
//add_action('wp_footer', 'fbmlsetup', 100);
//COMMENT BOX
function printbuttons($content) {
			
			$wpLoad = ABSPATH;

			if ((is_single() && get_option('print_button_posts') == 'on'))
			{ 	
				$content .="<a href=".plugins_url().""."/Printer-Friendly-WP/print.php?arl=".$wpLoad."&id="."".  get_the_ID() .""." target="."_blank"." rel='nofollow' class="."print-button"."></a>";
				
				return $content;

			}
			
			if ((is_page() && get_option('print_button_pages') == 'on'))
			{
				$content .="<a href=".plugins_url().""."/Printer-Friendly-WP/print.php?arl=".$wpLoad."&id=page_id="."".  get_the_ID() .""." target="."_blank"." rel='nofollow' class="."print-button"."></a>";
				
				return $content;
			}
			
	return $content;
}
add_filter ('the_content', 'printbuttons', 100);

// Add css file 
function itg_admin_css_all_page() {

	wp_register_style($handle = 'printpostpage', $src = plugins_url('css/printpostpage.css', __FILE__), $deps = array(), $ver = '1.0.0', $media = 'all');
 
	wp_enqueue_style('printpostpage');
}
 
add_action('wp_head', 'itg_admin_css_all_page');

}
?>