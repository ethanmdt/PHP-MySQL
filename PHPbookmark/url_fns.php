<?php 
function add_bm($new_url){

	echo "Attempting to add ".htmlspecialchars($new_url)."<br />";
	$valid_user = $_SESSION['valid_user'];

	$conn = db_connect();

	$result = $conn -> query("select * from bookmark
							  where username = '".$valid_user."'
							  and bm_URL = '".$new_url."'");
	if(($result) && ($result->num_rows > 0)) {
		throw new Exception("Bookmark already exists.", 1);
		
	}

	if (!$conn -> query("insert into bookmark values
						 ('".$valid_user."', '".$new_url."')")) {
		throw new Exception("Bookmark could not be inserted.", 1);
	}
	return true;
}

function get_user_urls($username) {
	$conn = db_connect();
	$result = $conn ->query("select bm_URL 
							 from bookmark
							 where username = '".$username."'");

	if (!$result) {
		return false;
	}

	$url_array = array();
	for ($count = 1; $row = $result -> fetch_row(); ++$count) {
		$url_array[$count] = $row[0];
	}

	return $url_array;
 }

function delete_bm($user, $url) {
	$conn = db_connect();

	if (!$conn->query("delete from bookmark
						where username ='".$user."'and bm_url='".$url."'")) {
		throw new Exception("Bookmark could not be deleted.", 1);
	}

	return true;
}