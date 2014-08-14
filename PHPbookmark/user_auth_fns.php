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
							where username='".$username."'and passwd = sha1('".$password."')");
	if (!$result) {
		throw new Exception("Could not connect database.", 1);
	}
	if ($result -> num_rows > 0) {
		return true;
	} else {
		throw new Exception("The password is wrong", 1);
	}
}

function check_valid_user() {
	if (isset($_SESSION['valid_user'])) {
		echo "logged in as ".$_SESSION['valid_user'].".<br />";
	} else {
		do_html_heading('Problem:');
		echo 'You are not logged in.<br />';
//		do_html_url('login.php', 'Login');
		do_html_footer();
		exit;
	}
}

function change_password($username, $old_passwd, $new_passwd) {
	login($username, $old_passwd);
	$conn = db_connect();
	$result = $conn -> query("update user
							  set passwd = sha1('".$new_passwd."')
							  where username = '".$username."'");
	if (!$result) {
		throw new Exception("Password could not be changed", 1);
	} else {
		return true;
	}
}

function reset_password($username) {
	$new_password = get_random_word(6,13);

	if ($new_password == false) {
		throw new Exception("Could not generate new password.", 1);
	}

	$rand_number = rand(0,999);
	$new_password .= $rand_number;

	$conn = db_connect();
	$result = $conn ->query("update user
							 set passwd = sha1('".$new_password."')
							 where username = '".$username."'");
	if (!$result) {
		throw new Exception("Could not change password.", 1);
	} else {
		return $new_password;
	}
}


function get_random_word($min_length, $max_length) {
	return "abcdef";
}

function notify_password($username, $password) {
	$conn = db_connect();
	$result = $conn -> query("select email from user
							  where username ='".$username."'");
	if (!$result) {
		throw new Exception("Could not find email address", 1);
	} else if ($result -> num_rows == 0) {
		throw new Exception("Could not find email address.", 1);
	} else {
		$row = $result -> fetch_object();
		$email = $row -> email;
		$from = "From: support@phpbookmark \r\n";
		$mesg = "Your PHPBookmark password has been changed to ".$password."\r\n"."Please change it next time you log in.\r\n";

		if (mail($email, 'PHPBookmark login information', $mesg, $from)) {
			return true;
		} else {
			throw new Exception("Could not send email", 1);
		}
	}

}
?>