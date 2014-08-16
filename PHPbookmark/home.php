<?php 
	require_once 'bookmark_fns.php';
	session_start();

	do_html_header('Home');
	check_valid_user();
	if ($url_array = get_user_urls($_SESSION['valid_user'])) {
		display_user_urls($url_array);
	}
	
	display_user_menu();
	do_html_footer();
?>