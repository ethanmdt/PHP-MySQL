<?php 
function register($username, $email, $password) {
	$conn = db_connect();

	$result = $conn->query("select * from user where username = '".$username."'");
	if (!$result) {
		throw new Exception("Could not excute query", 1);
	}
	if ($result -> num_rows > 0) {
		throw new Exception("That username is taken - go back and choose another one.", 1);
	}
	$result = $conn->query("insert into user values
						  ('".$username."', sha1('".$password."'), '".$email."')");
	if (!$result) {
		throw new Exception("Could not register you in database - please try again later.", 1);
	}
	return true;
} 
function login($username, $password) {
	$conn = db_connect();
	$result = $conn -> query("select * from user 
							where username='".$username."'and password = sha1('".password."')");
}
?>