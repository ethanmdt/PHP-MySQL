<?php
function do_html_header($title) {
?>
	<html>
		<head>
			<title><?php echo $title;?></title>
			<link rel="stylesheet" href="CSS/layout.css" type="text/css">
		</head>
		<body>
			<h1>PHPbookmark</h1>
			<hr/>
<?php
	if ($title) {
		do_html_heading($title);
	}
}

function do_html_footer() {
?>
		<a href="login.php" alt="click to back"><p>Login page</p></a>
		</body>
	</html>
<?php 
}

function do_html_heading($heading) {
?>
 	<h3><?php echo $heading ?></h3>
<?php 
}

function display_site_info() {
?>
	<ul>
		<li>Store your bookmarks online with us!</li>
		<li>See what other users use!</li>
		<li>Share your favorite links with others!</li>
	</ul>
<?php 
}

function display_login_form() {
?>
	<a href="register_form.php" alt="click to registe"><p>Not a member?</p></a>
	<form method = "POST" action="member.php">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username">
		<label for="password">Password:</label>
		<input type="password" name="password" id="password">
		<input type="submit" value="Log in">
	</form>
	<a href="forgot_form.php" alt="click to find out password"><p>Forgot your password?</p></a>
<?php 
}

function display_registration_form() {	
?>
	<form method= "POST" action="register_new.php">
		<label for="email">Email address:</label>
		<input type="email" name="email" id="email">
		<label for="username">Preferred username(max 16 chars):</label>
		<input type="text" name="username" id="username">
		<label for="passwd">Password (between 6 and 16 chars):</label>
		<input type="password" name="passwd" id="passwd">
		<label for="passwd2">Confirm password:</label>
		<input type="password" name="passwd2" id="passwd2">
		<input type="submit" value="Register">
	</form>
<?php 
}

function display_password_form() {
?>
	<form method="POST" action="change_passwd.php">
		<label for="old_passwd">Old password:</label>
		<input type="password" name="old_passwd" id="old_passwd">
		<label for="new_passwd">New password:</label>
		<input type="password" name="new_passwd" id="new_passwd">
		<label for="new_passwd2">Repeat new password:</label>
		<input type="password" name="new_passwd2" id="new_passwd2">
		<input type="submit" value="Change password">
	</form>
<?php 
}

function display_user_menu() {
?>
	<ul>
		<li><a href="logout.php">Logout</a></li>
		<li><a href="change_passwd_form.php">Change password</a></li>
	</ul>
<?php 
}
?>

