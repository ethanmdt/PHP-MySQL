<?php 
	require_once 'checkout.php';

	session_start();

	do_html_header("Checkout");

	if (($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
		display_cart($_SESSION['cart']);
		display_checkout_form();
	} else {
		echo "<p>There are no items in your cart</p>";
	}
	display_button("show_cart.php", "continue shopping", "Continue Shopping");

	do_html_footer();
 ?>