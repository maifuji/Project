<?php
//connect to database
$mysqli = mysqli_connect("localhost", "root", "", "Bonsai-shop");

$display_block = "<h1>My Categories</h1>
<p>Select a category to see its items.</p>";

//show categories first
$get_cats_sql = "SELECT id, cat_title, cat_desc 
FROM store_categories ORDER BY id";

$get_cats_res = mysqli_query($mysqli, $get_cats_sql)
or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_cats_res) < 1) {
$display_block = "<p><em>Sorry, no categories to browse.</em></p>";
} else {
while ($cats = mysqli_fetch_array($get_cats_res)) {
$cat_id  = $cats['id'];
$cat_title = strtoupper(stripslashes($cats['cat_title']));
$cat_desc = stripslashes($cats['cat_desc']);

$display_block = "<p><strong><a href=\"".$_SERVER['PHP_SELF']. 
"?cat_id=".$cat_id."\">".$cat_title."</a></strong><br/>"
.$cat_desc."</p>";

if (isset($_GET['cat_id']) && ($_GET['cat_id'] == $cat_id)) {
//create safe value for use
$safe_cat_id = mysqli_real_escape_string($mysqli,
$_GET['cat_id']);

//get items
$get_items_sql = "SELECT id, item_title, item_price
FROM store_items WHERE
cat_id = '".$cat_id."' ORDER BY item_title";
$get_items_res = mysqli_query($mysqli, $get_items_sql)
or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_items_res) < 1) {
$display_block = "<p><em>Sorry, no items in this category.</em></p>";
} else {
$display_block .= "<ul>";
while ($items = mysqli_fetch_array($get_items_res)) {
$item_id  = $items['id'];
$item_title = stripslashes($items['item_title']);
$item_price = $items['item_price'];

$display_block .= "<li><a href=\"showitem.php?item_id=".
$item_id."\">".$item_title."</a> (\$".$item_price.")</li>";

}
$display_block .= "</ul>";
}

//free results
mysqli_free_result($get_items_res);
}
}

}
//free results 
mysqli_free_result($get_cats_res);
//close connection to MySQL 
mysqli_close($mysqli);

?>


<!DOCTYPE html>
<html>
<head>

	<title>Shop</title>
	<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="bonsai.css">
<style type="text/css">
	#check{
		color: #789;
	}
</style>


</head>
<body>
	<div id="wrapper">
		
		
		<header>
			<img src="imgs/bonsai-1313531_1920.jpg" width="1920" height="1080" alt="bonsai">
		</header>

<nav class="menu">
	<ul>
		<li><a href="index.html">Home</a></li>
		<li><a href="whatbonsai.html">What's bonsai?</a></li>
		<li><a href="Gallery.html">Gallery</a></li>
		<li><a href="online_shop.php" id="current-page">Shop</a>
		<li><a href="contact.html">Contact&nbsp;us</a></li>
	</ul>
	
</nav>


	
<?php echo $display_block; ?>

<br>
<a href="showcart.php" id="check">Check shopping cart!!</a>


</div>
</body>
<footer>
	<ul><li>&copy;Bonsai 2019</li>
		<li><a href="privacy.html">Privacy</a></li>
		<li><a href="bonsai-bonsai.com">bonsai-bonsai.com</a></li>
</ul>

</footer>
</html>
