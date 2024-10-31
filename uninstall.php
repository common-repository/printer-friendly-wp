<?php
	//if uninstall not called from WordPress exit
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
		exit ();

	delete_option('print_button_posts');
	delete_option('print_button_pages');
?>