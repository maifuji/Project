
<!DOCTYPE html>
<html>
<head>

	<title>Bonsai</title>
	<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="bonsai.css">
</head>
<body>
	<div id="wrapper">
		
		
		<header>
			<img src="imgs/bonsai-1313531_1920.jpg" width="1920" height="1080" alt="bonsai">
		</header>

<nav class="menu">
	
	<ul>
		<li><a href="index.html" id="current-page">Home</a></li>
		<li><a href="whatbonsai.html">What's bonsai?</a></li>
		<li><a href="Gallery.html">Gallery</a></li>
		<li><a href="online_shop.php">Shop</a>
		<li><a href="contact.html">Contact&nbsp;us</a></li>
	</ul>
	
</nav>
<main>
	<div id="season">
	<figure class="spring">
		<img src="imgs/sakura.jpg" width="500" height="500" alt="spring_bonsai">
		<figcaption><a href="spring.html">Spring Bonsai</a></figcaption>
	</figure>

    <figure class="summer">
	    <img src="imgs/bonsai_su.jpg" width="500" height="500" alt="summer_bonsai">
	<figcaption><a href="summer.html">Summer Bonsai</a></figcaption>
    </figure>
    <figure class="autumn">
	    <img src="imgs/koubaibonsai20170224.jpg" width="500" height="500" alt="autumn_bonsai">
	<figcaption><a href="autumn.html">Autumn Bonsai</a></figcaption>
    </figure>
    <figure class="winter">
	    <img src="imgs/bonsai-1892619_640.jpg" width="500" height="500" alt="winter_bonsai">
	<figcaption><a href="winter.html">Winter Bonsai</a></figcaption>
    </figure>

    </div>
</main>




<h2>Add a Topic</h2>





<form method="post" action="do_addtopic.php">

<p><label>About:</label><br>
<select name="category_id" required="required">
    <option value="">Choose</option>
    <option value="1" name="1">Return</option>
    <option value="2" name="2">Care</option>
    <option value="3" name="3">Other</option>
</select></p>


<p><label for="topic_owner">Your Email Address:</label><br/>
   <input type="email" id="topic_owner" name="topic_owner" size="40" maxlength="150" required="required" /></p>

<p><label for="topic_title">Topic Title:</label><br/>
   <input type="text" id="topic_title" name="topic_title" size="40" maxlength="150" required="required" /></p>

<p><label for="post_text">Post Text:</label><br/>
   <textarea id="post_text" name="post_text" rows="8" cols="40" ></textarea></p>

   <button type="submit" name="submit" value="submit">Add Topic</button>

</form>



</div>



</body>
<footer>
	 <ul>

	 	<li>&copy;Bonsai 2019</li>
		<li><a href="privacy.html">Privacy</a></li>
		<li><a href="bonsai-bonsai.com">bonsai-bonsai.com</a></li>

     </ul>
</footer>
</html>