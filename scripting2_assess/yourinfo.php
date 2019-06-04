<?php

// start session
session_start();
 
include 'connect.php'; 
doDB();

//check for required fields from the form
if ((!$_POST['order_name']) || (!$_POST['order_address']) ||
(!$_POST['order_city']) || (!$_POST['order_state']) || (!$_POST['order_zip']) || 
(!$_POST['order_tel']) || (!$_POST['order_email'])|| (!$_POST['order_cardname']) || 
(!$_POST['order_cardnum']) || (!$_POST['expiry_date'])) { 
header("Location: checkout.php"); 
exit;

}

//create safe values for input into the database
$clean_order_name = mysqli_real_escape_string($mysqli,$_POST['order_name']);
$clean_order_address = mysqli_real_escape_string($mysqli,$_POST['order_address']);
$clean_order_city = mysqli_real_escape_string($mysqli,$_POST['order_city']);
$clean_order_state = mysqli_real_escape_string($mysqli,$_POST['order_state']);
$clean_order_zip = mysqli_real_escape_string($mysqli,$_POST['order_zip']);
$clean_order_tel = mysqli_real_escape_string($mysqli,$_POST['order_tel']);
$clean_order_email = mysqli_real_escape_string($mysqli,$_POST['order_email']);
$clean_order_cardname = mysqli_real_escape_string($mysqli,$_POST['order_cardname']);
$clean_order_cardnum = mysqli_real_escape_string($mysqli,$_POST['order_cardnum']);
$clean_expiry_date = mysqli_real_escape_string($mysqli,$_POST['expiry_date']);

//create and issue the first query
$add_topic_sql = "INSERT INTO store_orders
(order_date, order_name, order_address, order_city, order_state, order_zip, order_tel, order_email,order_cardname,order_cardnum,expiry_date) 
VALUES (now(),'".$clean_order_name ."', '".$clean_order_address."', '".$clean_order_city."', '".$clean_order_state."', '".$clean_order_zip."', '".$clean_order_tel."', '".$clean_order_email."','".$clean_order_cardname."','".$clean_order_cardnum."','".$clean_expiry_date."')";

$add_topic_res = mysqli_query($mysqli, $add_topic_sql)
or die(mysqli_error($mysqli));

//get the id of the last query
$order_id = mysqli_insert_id($mysqli);

//check for cart items based on user session id
$get_cart_sql = "SELECT st.sel_item_id, si.item_title, si.item_price,
st.sel_item_qty, st.sel_item_size, st.sel_item_color FROM
store_shoppertrack AS st LEFT JOIN store_items AS si ON
si.id = st.sel_item_id WHERE session_id =
'".$_COOKIE['PHPSESSID']."'";

$get_cart_res = mysqli_query($mysqli, $get_cart_sql)
or die(mysqli_error($mysqli));

//inside of the shopping cart
while ($cart_info = mysqli_fetch_array($get_cart_res)) {
$id = mysqli_real_escape_string ($mysqli,$cart_info['sel_item_id']);
$item_title = mysqli_real_escape_string ($mysqli,$cart_info['item_title']);
$item_price = mysqli_real_escape_string ($mysqli,$cart_info['item_price']);
$item_qty = mysqli_real_escape_string ($mysqli,$cart_info['sel_item_qty']);
$item_color = mysqli_real_escape_string ($mysqli,$cart_info['sel_item_color']);
$item_size = mysqli_real_escape_string ($mysqli,$cart_info['sel_item_size']);

$add_store_order_sql="INSERT INTO store_orders_items
(order_id,sel_item_id,sel_item_qty,sel_item_size,sel_item_color,sel_item_price)
VALUES ('".$order_id."','".$id."','".$item_qty."','".$item_size."','".$item_color."','".$item_price."')";


$add_store_order_res = mysqli_query($mysqli, $add_store_order_sql)
or die(mysqli_error($mysqli));

//stock update
$stock_update_sql="UPDATE `store_items`
SET `store_items`.item_stock = `store_items`.item_stock - $item_qty
WHERE `store_items`.id = $id";
$stock_update_res=mysqli_query($mysqli,$stock_update_sql)
or die(mysqli_error($mysqli));

}
//Delete shoppertrack
$delete_shoppertrack_sql = "DELETE FROM `store_shoppertrack` WHERE `store_shoppertrack`.session_id = '".$_COOKIE['PHPSESSID']."'";

$delete_shoppertrack_res = mysqli_query($mysqli, $delete_shoppertrack_sql)
or die(mysqli_error($mysqli));

//clear cookie
if(isset($_COOKIE['PHPSESSID'])){
	setcookie('PHPSESSID',null,-1 ,'/');

}

//free result
mysqli_free_result($get_cart_res);

//close connection to MySQL 
mysqli_close($mysqli);

?>

<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<h1>Thank you for your shopping.</h1>



<p><a href="index.html">TOP</a></p>
</body>
</html>

