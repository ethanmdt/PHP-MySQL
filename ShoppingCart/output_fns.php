<?php

function do_html_header($title) {
?>
	<html>
		<head>
			<title><?php echo $title;?></title>
			<link rel="stylesheet" href="CSS/layout.css" type="text/css">
		</head>
		<body>
			<header>
				<img src="images/Book-O-Rama.gif" alt="h1" id="header">
				<a href="show_cart.php"><img src="images/view-cart.gif" alt="View Cart" id="view_cart"></a>
			</header>
		
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

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
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

function display_books($book_array) {
	if (!is_array($book_array)) {
		echo "<p>No books currently available in this category</p>";
	} else {
		echo "<table>";
		foreach ($book_array as $row) {
			$url="show_book.php?isbn=".$row['isbn'];
			echo "<tr><td>";
			if (@file_exists("image/".$row['isbn']."jpg")) {
				$title = "<img src=\"image/".$row['isbn'].".jpg\"/>";
				do_html_url($url,$title);
			} else {
				echo "&nbsp";
			}

			echo "</td><td>";
			$title = $row['title']." by ".$row['author'];
			do_html_url($url,$title);
			echo "</td></tr>";
		}
		echo "</table>";
	}
	echo "<hr/>";
}

function display_book_details($book){
	if(!is_array($book)) {
		echo "<p>The details of this book cannot be displayed at this time.</p>";
	} else {
		echo "<table><tr>";
		$img = "image/".$book['isbn'].".jpg";
		if ($file_exists($img)) {
			echo "<td><img src=$img></td>";
		}
		echo "<td><ul>";
		echo "<li><strong>Author:</strong>".$book['author']."</li>";
		echo "<li><strong>ISBN:</strong>".$book['isbn']."</li>";
		echo "<li><strong>Our Price:</strong>".$book['price']."</li>";
		echo "<li><strong>Description:</strong>".$book['description']."</li>";
		echo "</ul></td></tr></table>";
	}
	echo "<hr />";
}

function display_cart($cart) {

?>
	<table>
		<tr>
			<th>Item</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
<?php 
		$total_price = 0;
		$total_quantity = 0;
		foreach ($cart as $isbn => $num) {
			$row = get_book_details($isbn);
			$img = "images/".$isbn.".jpg";
			echo "<tr><td>";
			if (file_exists($img)) {
				echo "<img src=\"images/$img.jpg\">";
			} else {

				echo "&nbsp";
			}
			echo $row['title']." by ".$row['author']."</td>";
			echo "<td>".$row['price']."</td>";
			echo "<td>".$num."</td>";
			echo "<td>".$num*$row['price']."</td></tr>";
			$total_price+=$num*$row['price'];
			$total_quantity+=$num;
		}
		echo "<tr><td></td><td></td><td>".$total_quantity."</td><td>".$total_price."</td></tr>";

 ?>
	</table>

<?php 
function display_button($target, $image, $alt) {
	echo "<a href=\"$target\"><img src=\"images/$image.jpg\" alt=\"$alt\"></a>";
}

function display_checkout_form() {
?>
	<h1>Your Details</h1>
	<label for="name">Name</label>
	<input type="text" name="name" id="name">
	<label for="address">Address</label>
	<input type="text" name="address" id="address">
	<label for="city">City/Suburb</label>
	<input type="text" name="city" id="city">
	<label for="state">State/Province</label>
	<input type="text" name="state" id="state">
	<label for="postal">Postal Code or Zip Code</label>
	<input type="text" name="postal" id="postal">
	<label for="country">Country</label>
	<input type="text" name="country" id="country">
	<h1>Shipping Address(leave blank if as above)</h1>
	<label for="name2">Name</label>
	<input type="text" name="name2" id="name2">
	<label for="address2">Address</label>
	<input type="text" name="address2" id="address2">
	<label for="city2">City/Suburb</label>
	<input type="text" name="city2" id="city2">
	<label for="state2">State/Province</label>
	<input type="text" name="state2" id="state2">
	<label for="postal2">Postal Code or Zip Code</label>
	<input type="text" name="postal2" id="postal2">
	<label for="country2">Country</label>
	<input type="text" name="country2" id="country2">
	<p>Please press Purchase to confirm your purchase,or Continue Shopping to add or remove items</p>
<?php 
	display_button("purchase.php", "purchase", "Purchase");
}
?>

