<?php 
	function db_result_to_array($result) {
		$res_array = array();

		for ($count =0; $row = $result->fetch_assoc(); $count++) {
			$res_array[$count] = $row;
		}

		return $res_array;
	}
	
function db_connect() {
	$result = new mysqli('localhost', 'bm_user', 'password', 'bookmarks');
	if (!$result) {
		throw new Exception("Could not connect to database server", 1);
	} else {
		return $result;
	}
} 
 ?>