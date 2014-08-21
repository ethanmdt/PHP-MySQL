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
	<hr>
	<ul id="menu">
		<li><a href="home.php">Home</a></li>
		<li><a href="logout.php">Logout</a></li>
		<li><a href="change_passwd_form.php">Change password</a></li>
		<li><a href="add_bm_form.php">Add BM</a></li>
		<li><a href="recommend.php">Rcommend URLS to me</a></li>
	</ul>
<?php 
}

function display_reset_form() {
?>
	<form method="POST" action="forgot_passwd.php">
		<label for="username">Enter your username</label>
		<input type="text" name="username" id="username">
		<input type="submit" value="Change password">
	</form>
<?php 
} 

function display_add_bm_form() {
?>
	<form method="POST" action="add_bms.php">
		<label for="new_bm">New BM:</label>
		<input type="text" name="new_bm" id="new_bm">
		<input type="submit" value="Add bookmark">
	</form>
<?php 
} 

function display_user_urls($url_array) {
?>
	<form method="POST" action="delete_bms.php">
<?php 
	if ((is_array($url_array)) && (count($url_array) > 0)) {
		foreach ($url_array as $url) {
			echo "<a href=\"$url\">".htmlspecialchars($url)."</a>";
			echo "<input type=\"checkbox\" name=\"del_me[]\" value=\"".$url."\"/>";
		}
?>
	<input type="submit" value="Delete BM">
<?php  
	} else {
		echo "<h3>No bookmarks on record<h3>";
	}	
 ?>
	</form>
<?php 
}

function display_recommend_urls($url_array) {

	if ((is_array($url_array)) && (count($url_array) > 0)) {
		foreach ($url_array as $url) {
			echo "<a href=\"$url\">".htmlspecialchars($url)."</a><br/>";
		}
	}
}

function display_categories($cat_array) {
	if (!is_array($cat_array)) {
		echo "<p> No categories currently available</p>";
		return;
	}
	echo "<ul>";
	foreach ($cat_array as $row) {
		$url = "show_cat.php?catid=".($row['catid']);
		$title = $row['catname'];
		echo "<li>";
		do_html_url($url,$title);
		echo "</li>";
	}
	echo "</ul>";
	echo "<hr />";
}
?>