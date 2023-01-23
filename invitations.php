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
	$invites = "SELECT Inviter_name, Inviter_no, Inviter_dog, Play_date, Play_time FROM playdates
				WHERE Invitee_name = '{$_SESSION["username"]}'";
	$inv = "SELECT Invitee_name, Invitee_no, Play_date, Play_time FROM playdates
					WHERE Inviter_name = '{$_SESSION["username"]}'";
	?>
	<title>Puppy Play Dates</title>
</head>
<body>
	<nav class="navbar">
		<a href="homepage.php"><img src="images/pdlogo.png" class="pdlogo"></a>
		<a href="homepage.php" class= "pdnavlink">log out</a>
		<a href="playdate.php" class= "pdnavlink">find a match</a>
		<a class="pdname">Welcome, <?php echo $_SESSION["username"]; ?>!</a>
	</nav>
	<div class="pdbanner">
		<img src="images/playdateleft.png" class="pdimage">
		<h1>Here are <?php  echo $_SESSION["dogname"]; ?>'s invitations for play dates:</h1>
	</div>
	<table id="invitedtable">
		<?php
			if ($res = mysqli_query($conn, $invites)) {
			?>
			<tr>
				<th>Who?</th>
				<th>When?</th>
				<th>Response</th>
			</tr>
			<?php
				while ($rows=mysqli_fetch_assoc($res)) {
			?>
			<tr>
				<td class="matchtable"><?php echo $rows['Inviter_name'];?>'s dog <?php echo $rows['Inviter_dog'];?>
				would like to play</td>
				<td class="matchtable"> <?php echo $rows['Play_date'];?> at <?php echo $rows['Play_time'];?></td>
				<td class="matchtable"><button>response</button></td>
				</tr>
				<?php
				}
			}
				?>
	</table>
	<table id="invitestable">
		<?php
			if ($res2 = mysqli_query($conn, $inv)) {
		?>
		<tr>
		<th>Who?</th>
		<th>When?</th>
		<th>Response</th>
		</tr>
		<?php
			while ($rows=mysqli_fetch_assoc($res2)) {
		?>
			<tr>
				<td class="matchtable"><?php echo $rows['Invitee_name'];?></td>
				<td class="matchtable"><?php echo $rows['Play_date'];?> at <?php echo $rows['Play_time'];?></td>
				<td class="matchtable"><button>response</button></td>
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