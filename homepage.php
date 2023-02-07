<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="stylesheet.css" />
	<link rel="stylesheet" href="https://use.typekit.net/xcc5lpj.css">
	<title>Home</title>
	<?php
	//log out when this page is loaded
	session_destroy();
	//connect or create the database and tables
	include "connect.php";
	?>
</head>
<body>
	<nav class="navbar">
		<a href="homepage.php"><img src="images/logo.png" class="logo"></a>
		<img src="images/profile.png" onclick="openForm()" class="prof navlink">
		<a href="findus.html" class="navlink">find us</a>
		<a href="services.html" class="navlink">our services</a>
		<a href="meetus.html" class="navlink">meet us</a>
	</nav>
	<div class="landing">
		<!-- pressing the button on this image will change the users preference to cat person, dog person or both -->
		<img src="images/maindog.jpg" id="mainimage">
		<bu type="button" id="userchoice" onclick="changeusertype()"><img src="images/dogwhite.png" height="25px"> or <img src="images/catwhite.png" height="25px"> or <img src="images/cdw.png" height="25px">?</button>
	</div>
	<div class="options">
		<!-- navigation to other pages -->
		<div class="column first">
			<a href="findus.html"><img src="images/find.png" class="imagelink"></a>
		</div>
		<div class="column second">
			<a href="services.html"><img src="images/services.png" class="imagelink"></a>
		</div>
		<div class="column">
			<a href="meetus.html"><img src="images/meet.png" class="imagelink"></a>
		</div>
	</div>
	<!-- sign up and log in pop up form to join the puppy play dates service-->
	<div class="form-popup" id="myForm">
		<form class="form-container" action="user.php" method="POST" enctype='multipart/form-data'>
			<button type="button" class="cancel" onclick="closeForm()">x</button><br><br>
			<button type="button" class="btn" onclick="loginForm()">Log In</button>
			<h1 style="font-size: 25px;">Create a Puppy Play Date Account</h1>
			<label for="first_name"><b>First Name:</b></label><br>
			<input type="text" placeholder="Enter your first name" name="first_name" required><br>
			<label for="surname"><b>Surname:</b></label><br>
			<input type="text" placeholder="Enter your last name" name="surname" required><br>
			<label for="password"><b>Password:</b></label><br>
			<input type="password" placeholder="********" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onfocus="passwordpopup()" onblur="passwordhide()" required><br>
			<p class="passm" id="passmessage">Password must contain uppercase & lowercase letters, a symbol and it must be 6 characters long</p>
			<label for="phone"><b>Phone Number:</b></label><br>
			<input type="tel" placeholder="0400123456" name="phone" pattern="[0]{1}[0-9]{9}"required><br>
			<label for="e-mail"><b>E-mail:</b></label><br>
			<input type="email" placeholder="jon@mail.com" name="e-mail" required><br>
			<label for="suburb"><b>Suburb:</b></label><br>
			<input type="text" placeholder="Enter the name of your suburb" name="suburb" id ="suburb" required><br>
			<label for="postcode"><b>Postcode:</b></label><br>
			<input type="text" placeholder="Enter your postcode" name="postcode" id="postcode" pattern="[0-9]{4}" required><br>
			<label for="dog_name"><b>Dog's Name:</b></label><br>
			<input type="text" placeholder="Enter your dog's name" name="dog_name" required><br>
			<label for="dog_breed"><b>Dog Breed:</b></label><br>
			<input type="text" placeholder="Enter your dog's breed" name="dog_breed" required><br>
			<label for="dog_age"><b>Dog's Age:</b></label><br>
			<input type="number" placeholder="Enter your dog's age in human years" name="dog_age" required><br>
			<label for="dog_gender"><b>Dog's Gender:</b></label><br>
			<input type="radio" name="dog_gender" id="female" value="female">
			<label for="female">Female</label>
			<input type="radio" name="dog_gender" id="male" value="male">
			<label for="male">Male</label><br>
			<label for="image"><b>Upload a picture of your pet:</b></label><br>
			<input type="file" name="image" required><br><br>
			<button type="submit" class="btn">Submit</button>
		</form>
	</div>
	<div class="form-popup" id="myLogin">
		<form class="form-container" action="login.php" method="POST">
			<button type="button" class="cancel" onclick="back()">&lt;</button>
			<h1>User Login</h1>
			<label for="e-mail"><b>E-mail:</b></label><br>
			<input type="email" placeholder="jon@mail.com" name="e-mail" size="30" required><br>
			<label for="password"><b>Password:</b></label><br>
			<input type="password" placeholder="********" name="password" required><br><br>
			<button type="submit" class="btn">Log In</button>
			</form>
			</div>
	<footer class="footer">
		<div classs="container">
			<div class="socials">
				<h2>Connect with us:</h2>
				<a href="https://www.instagram.com"><img src="images/insta.png" class="sociallinks"></a>
				<a href="https://www.facebook.com"><img src="images/facebook.png" class="sociallinks"></a>
				<a href="https://twitter.com"><img src="images/twitter.png" class="sociallinks"></a>
			</div>
			<div class="socials">
				<a href="findus.html"><img src="images/contact.png" id="contactbox"></a>
			</div>
		</div>
		<div class="logofooter">
			<img src="images/whitelogo.png" id="footerlogo">
		</div>
	</footer>
</body>
<script type="text/javascript" src="betterpets.js"></script>
</html>