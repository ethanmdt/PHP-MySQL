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

	$customerid = $conn->
}
?>
