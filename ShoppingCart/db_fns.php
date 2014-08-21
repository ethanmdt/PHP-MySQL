<?php 
	function db_result_to_array($result) {
		$res_array = array();

		for ($count =0; $row = $result->fetch_assoc(); $count++) {
			$res_array[$count] = $row;
		}

		return $res_array;
	}
 ?>