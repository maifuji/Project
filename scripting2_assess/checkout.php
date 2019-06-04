<?php 
session_start();

//connect to database
$mysqli = mysqli_connect("localhost", "root", "", "Bonsai-shop");
$subtotal = 0;
$display_block = "<h1>Your order</h1>";

//check for cart items based on user session id
$get_cart_sql = "SELECT st.id, si.item_title, si.item_price, st.sel_item_qty, st.sel_item_size, 
st.sel_item_color FROM store_shoppertrack AS st LEFT JOIN store_items AS si ON si.id = 
st.sel_item_id WHERE session_id = '".$_COOKIE['PHPSESSID']."'";
$get_cart_res = mysqli_query($mysqli, $get_cart_sql)
or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_cart_res) < 1) {

//print message
$display_block .= "<p>You have no items in your cart. Please <a href=\"online_shop.php\">continue to 
shop</a>!</p>";
} else {
//get info and build cart display
$display_block .= <<<END_OF_TEXT
<table>
<tr>
<th>Title</th>
<th>Size</th>
<th>Color</th>
<th>Price</th>
<th>Qty</th>
<th>Total Price</th>
</tr> 



END_OF_TEXT;

while ($cart_info = mysqli_fetch_array($get_cart_res)) {
$id = $cart_info['id'];
$item_title = stripslashes($cart_info['item_title']);
$item_price = $cart_info['item_price'];
$item_qty = $cart_info['sel_item_qty'];
$item_color = $cart_info['sel_item_color'];
$item_size = $cart_info['sel_item_size'];
$total_price = sprintf("%.02f", $item_price * $item_qty);

$subtotal = $subtotal+ $total_price;

$display_block .= <<<END_OF_TEXT
<tr>
<td>$item_title <br></td>
<td>$item_size <br></td>
<td>$item_color <br></td>
<td>\$ $item_price <br></td>
<td>$item_qty <br></td>
<td>\$ $total_price</td>
</tr>
END_OF_TEXT;
}
$display_block .= "</table>";


}
$display_block .= <<<END_OF_TEXT
<p id="total">Total : \$ $subtotal</P>

END_OF_TEXT;
$display_block .="</table>";

//free result 
mysqli_free_result($get_cart_res);
//close connection to MySQL
mysqli_close($mysqli);

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
	<title>Add your details</title>
	
	<style media="screen">
		.error { color: red; }
	
table {
border: 1px solid black; border-collapse: collapse;
width: 100%;
height: auto;
}
th {
border: 1px solid black; 
font-weight: bold; background: #ccc; text-align: center;

}
td {
border: 1px solid black; padding: 6px;
vertical-align: top; text-align: center;

}
#total {
text-align: right;
margin-right: 80px;
}
</style>

</head>

<body>
<?php echo $display_block; 
$mysqli = mysqli_connect("localhost", "root", "", "online_store");

?>




<h1>Payment</h1>
	<form action="yourinfo.php" method="post" id="addyour_details">
		<fieldset>Please complete your information
	    <p>	
	    	<label>Yourname:</label>
		    <input type="text" name="order_name"></p>
		<p>
			<label>Address:</label>
			<input type="text" name="order_address">
		</p>
		<p>
			<label>City:</label>
			<input type="text" name="order_city">
		</p>
		<p>
			<label>State:</label>
			<input type="text" name="order_state">
		</p>
		<p>
			<label>Postcode:</label>
			<input type="text" name="order_zip">
		</p>
		<p><label>TEL:</label>
			<input type="text" name="order_tel">
		</p>
		<p><label>Email:</label>
			<input type="email" name="order_email">
		</p>
		<p>
		    <label>Card name:</label>
		    <input type="text" name="order_cardname">
	    </p>
	    <p>
		    <label>Card Number:</label>
		    <input type="text" name="order_cardnum">
	    </p>
	    <p>
		    <label>Expiry date:</label>
		    <input type="text" name="expiry_date">
		</p>
		<p>
	        <input type="submit" name="conform" value="conform">
	    </p>
        </fieldset>
    </form>


<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a>
<p><a href="index.html">TOP</a></p>

</body>
</html>