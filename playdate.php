<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="stylesheet.css" />
	<link rel="stylesheet" href="https://use.typekit.net/xcc5lpj.css">
	<?php
	ini_set('display_errors', 'on');
	ini_set('log_errors', 'on');
	ini_set('display_startup_errors', 'on');
	ini_set('error_reporting', E_ALL);
	include "connect.php";
	session_start();
	$breeds = "SELECT User_Firstname, Dog_Name, Dog_Image, Phone_no FROM user_info
				WHERE Dog_Breed = '{$_SESSION["dogbreed"]}' && Phone_no != '{$_SESSION["phone"]}'";

	$ages = "SELECT User_Firstname, Dog_Name, Dog_Image, Phone_no FROM user_info
				WHERE Dog_Age = '{$_SESSION["dogage"]}' && Phone_no != '{$_SESSION["phone"]}'";

	$genders = "SELECT User_Firstname, Dog_Name, Dog_Image, Phone_no FROM user_info
					WHERE Dog_Gender = '{$_SESSION["doggender"]}' && Phone_no != '{$_SESSION["phone"]}'";
	?>
	<title>Puppy Play Dates</title>
</head>
<body>
	<nav class="navbar">
		<a href="homepage.php"><img src="images/pdlogo.png" class="pdlogo"></a>
		<a href="homepage.php" class= "pdnavlink">log out</a>
		<a href="invitations.php" class= "pdnavlink">invitations</a>
		<a class="pdname">Welcome, <?php echo $_SESSION["username"]; ?>!</a>
	</nav>
	<div class="invite-popup" id="inviteForm">
		<form class="invite-container" action="invites.php" method="POST">
			<button type="button" class="pdcancel" onclick="closeMatch()">x</button>
			<h2>Pick a date & time for your play date</h2>
			<label id="pdlabel" for="date">Please select a date:</label>
			<input id="pdinput" type="date" name="date" required>
			<label id="pdlabel" for="time">Please select a time:</label>
			<input id="pdinput" type="time" name="time" required>
			<input id="inviteeid" type="hidden" name="id">
			<button type="submit" class="pdbtn">Submit</button>
			<label id="pdlabel" for="button">*Please note that if your invitation is accepted, the invitee will recieve 
											your name and phone number.
		</form>
	</div>
	<div class="pdbanner">
		<img src="images/playdateleft.png" class="pdimage">
		<h1>Organise a play date for <?php  echo $_SESSION["dogname"]; ?>:</h1>
	</div>
		<h5> Pick a play mate for <?php  echo $_SESSION["dogname"]; ?> based on one of the following options:</h5>
		<div class="sortdogs">
		<button class="selectmatch" onclick="pullInfo(1)">Same Breed </button>
		<button class="selectmatch" onclick="pullInfo(2)">Same Age </button>
		<button class="selectmatch" onclick="pullInfo(3)">Same Gender </button>
		</div>
		<table id="breedtable">
			<tr>
				<th colspan="2" class="matchtable">Matches by Breed</th>
			</tr>
			<?php
			if ($res1 = mysqli_query($conn, $breeds)) {
				while ($rows=mysqli_fetch_assoc($res1)) {
			?>
			<tr>
				<td class="matchtable"><?php echo $rows['User_Firstname'];?>'s dog <?php echo $rows['Dog_Name'];?>
				<br><?php echo"<img src='".$rows['Dog_Image']."' height='200px'>"?></td>
				<td class="matchtable"><button class="selectmatch"
				onclick="selectMatch(<?php echo $rows['Phone_no'];?>)">Invite for a play</button>
				</tr>
				<?php
				}
			} 
			?>
		</table>
		<table id="agetable">
			<tr>
			<th colspan="2" class="matchtable">Matches by Age</th>
			</tr>
			<?php
			if ($res2 = mysqli_query($conn, $ages)) {
				while ($rows=mysqli_fetch_assoc($res2)) {
			?>
			<tr>
				<td class="matchtable"><?php echo $rows['User_Firstname'];?>'s dog <?php echo $rows['Dog_Name'];?>
				<br><?php echo"<img src='".$rows['Dog_Image']."' height='200px'>"?></td>
				<td class="matchtable"><button class="selectmatch"
				onclick="selectMatch(<?php echo $rows['Phone_no'];?>)">Invite for a play</button>
				</tr>
				<?php
				}
			}
				?>
		</table>
		<table id="gendertable">
			<tr>
			<th colspan="2" class="matchtable">Matches by Gender</th>
			</tr>
			<?php
			if ($res3 = mysqli_query($conn, $genders)) {
				while ($rows=mysqli_fetch_assoc($res3)) {
			?>
			<tr>
				<td class="matchtable"><?php echo $rows['User_Firstname'];?>'s dog <?php echo $rows['Dog_Name'];?>
				<br><?php echo"<img src='".$rows['Dog_Image']."' height='200px'>"?></td>
				<td class="matchtable"><button class="selectmatch"
				onclick="selectMatch(<?php echo $rows['Phone_no'];?>)">Invite for a play</button>
				</tr>
				<?php
				}
			}
				?>
		</table>
	<footer class="pdfooter">
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