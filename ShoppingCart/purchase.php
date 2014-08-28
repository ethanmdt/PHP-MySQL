<?php 
	require_once 'book_sc_fns.php';

	session_start();

	do_html_header("Checkout");

	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$zip = $_POST['postal'];
	$country = $_POST['country'];

	if (($_SESSION['cart']) && ($name) && ($address) && ($city) && ($zip) && ($country)) {
		if (insert_order($_POST) != false) {
			display_cart($_SESSION['cart']);

			display_shipping(calculate_shipping_cost());

			display_card_form($name);

			display_button("show_cart.php", "continue-shopping", "Continue Shopping");

		} else {
			echo "<p>Could not store data, please try again.</p>";
			display_button("checkout.php", "back", "Back");
		}
	} else {
		echo "<p>You did not fill in all the fields, please try again.</p><hr/>";
		display_button("checkout.php","back", "Back");
	}

	do_html_footer();
 ?>