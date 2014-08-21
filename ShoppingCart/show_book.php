<?php 
	require_once 'book_sc_fns.php';
	session_start();

	$isbn = $_GET['isbn'];

	$book = get_book_details($isbn);
	do_html_header($book['title']);
	display_book_details($book);

	$target = "index.php";
	if ($book['catid']) {
		$target = "show_cat.php?catid=".$book['catid'];
	}

	if (check_admin_user()) {
		display_button("edit_book_form.php")
	}
 ?>