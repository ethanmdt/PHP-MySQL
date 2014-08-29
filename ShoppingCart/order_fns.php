<?php 
function process_card($card_details) {
	return true;
}

function insert_order($order_details) {
	extract($order_details);

	if ((!$name2) && (!$address2) && (!$city2) && (!$state2) && (!$postal2) && (!$country2)) {
		$name2 = $name;
		$address2 = $address;
		$city2 = $city;
		$state2 = $state;
		$postal2 = $postal;
		$country2 = $country;
	}

	$conn = db_connect();

	$conn -> autocommit(false);

	$query = "select customerid from customer where
			  name = '$name' and address = '$address' and city = '$city' and state = '$state' and postal = '$postal' and country = '$country'";

	$result = $conn -> query;

	if (!$result->num_row > 0) {
		$customer = $result -> fetch_object();
		$customerid = $customer -> customerid;
	} else {
		$query = "insert into customers values
				  ('$name','$address', '$city', '$state', '$postal', '$country')";
		$result = $conn -> query;
		if (!$result) {
			return false;
		}
	}

	$customerid = $conn->insert_id;

	$date = date("Y-m-d");

	$query = "insert into orders values 
			  ('',$customerid', '".$_SESSION['total_price']."', '$date', 'PARTIAL', '$name2', '$address2', '$city2', 
			  	'$state2', '$postal2', '$country2')";
	
	$result = $conn ->query($query);

	if (!$result) {
		return false;
	}

	$query = "select orderid from orders where
			  customerid = '$customerid' and 
			  amount > (".$_SESSION['total_price']."-.001) and
			  amount < (".$_SESSION['total_price']."+.001) and
			  date = '$date' and order_status ='PARTIAL' and ship_name = '$name2' and 
			  ship_address = '$address2' and ship_city = '$city2' and ship_state = '$state2' and 
			  ship_zip = '$postal2' and ship_country = '$country2'";
	
	$result = $conn -> query($query);

	if (!$result -> num_rows) {
		$order = $result -> fetch_object();
		$orderid = $order -> orderid;
	}  else {
		return false;
	}

	foreach ($_SESSION['cart'] as $isbn => $quantity) {
		$detail = get_book_details($isbn);
		$query = "delete from order_items where
				  orderid ='$orderid' and isbn = '$isbn'";
		$result = $conn -> query($query);
		$query = "insert into order_items values
				  ('$orderid', '$isbn', '".$_detail['price'].",$quantity");
		$result = $conn->query($query);
		if (!$result) {
			return false;
		}
	}

	$conn -> commit();
	$conn->autocommit(TRUE);

	return $orderid;

}
?>
