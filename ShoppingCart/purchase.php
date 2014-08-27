<?php 
	require_once 'book_sc_fns.php';

	session_start();

	do_html_header("Checkout");

	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$zip = $_POST['zip'];
	$country = $_POST['country'];

	if (($_SESSION['cart']) && ($name) && ($address) && ($city) && ($zip) && ($country)) {
		if (insert_order($_POST) != false) {
			display_cart($_SESSION['cart']);

			display_shipping(calculate_shipping_cost());

			display_card_form($name);

		} else {
			echo "<p>Could not store data, please try again.</p>";

		}
	} else {
		echo "<p>You did not fill in all the fields, please try again.</p><hr/>";
	}

	do_html_footer();
 ?>