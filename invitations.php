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
	$interval = date('d-m-y', strtotime('-7 days'));
	$query3 = "DELETE FROM playdates WHERE (Date_created < '{$interval}') && (Response = 'Declined')";
	if (!mysqli_query($conn, $query3)) {
	  echo '<script>console.log("Removal of records unsuccessful");</script>';
	} else {
	  echo '<script>console.log("Record check successful"); </script>';
	}
	$invites = "SELECT ID, Inviter_name, RIGHT(Inviter_no, 10) as Inviter_ph, Inviter_dog, Play_date, LEFT(Play_time, 5)as F_Play_time, Response FROM playdates
				WHERE Invitee_name = '{$_SESSION["username"]}'";
	$inv = "SELECT Invitee_name, RIGHT(Invitee_no, 10) as Invitee_ph, Invitee_mail, Play_date, LEFT(Play_time, 5) as F_Play_time, Response FROM playdates
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
		<h1>Here are <?php echo $_SESSION["dogname"];?>'s invitations for play dates:</h1>
	</div>
	<table id="invitedtable">
			<tr>
				<th class="matchtable">Who?</th>
				<th class="matchtable">When?</th>
				<th class="matchtable">Respond</th>
		</tr>
		<?php
		$res = mysqli_query($conn, $invites);
		while ($rows=mysqli_fetch_assoc($res)) {
		?>
			<tr>
			<form method="post">
				<td class="matchtable1"><?php echo $rows['Inviter_name'];?>'s dog <br><?php echo $rows['Inviter_dog'];?>
				would like to play</td>
				<input type="hidden" name="inviter" value=<?php echo $rows['Inviter_name'];?>>
				<input type="hidden" name="inviter_ph" value=<?php echo $rows['Inviter_ph'];?>>
				<td class="matchtable1"> <?php echo $rows['Play_date'];?><br>at <?php echo $rows['F_Play_time'];?></td>
				<input type="hidden" name="date" value=<?php echo $rows['Play_date'];?>>
				<?php
					if ($rows['Response'] === 'No Reply') {
				?>
				<td class="matchtable1">
					<input type="submit" name="resyes" id="res"><label for="resyes" id="reslab">Accept</label>
					<input type="submit" name="resno" id="res"><label for="resno" id="reslab">Decline</label>
				</td>
				<?php
					} else if ($rows['Response'] === 'Accepted'){
				?>
						<td class="matchtable1"><?php echo $rows['Response'];?>
						<br>(<?php echo $rows['Inviter_name'];?>'s phone<br> no:<?php echo $rows['Inviter_ph'];?>)
				<?php
					} else {
				?>
						<td class="matchtable1"><?php echo $rows['Response'];?>
				<?php
					}
				?>
			<?php 
			$today = date('Y-m-d');
			$res = mysqli_query($conn, $invites);
			$rows=mysqli_fetch_assoc($res);
			$play = $rows['Play_date'];
			if ($today >= $play) {
				?>
			<br><a id="remove_row" href="delete.php?ID=<?php echo $rows['ID']; ?>">Delete</a>
			<?php
			}
			?>
			</td>
			</form>
			</tr>
		<?php
		}
        if(isset($_POST['resyes'])) {
			if(isset($_POST['inviter']) || isset($_POST['inviter_no']) || isset($_POST['date'])) {
			$inviter= $_POST['inviter'];
			$inviter_ph= $_POST['inviter_ph'];
			$day= $_POST['date'];
			} else {
				echo '<script>alert("Something went wrong!");</script>';
			}			
			$query= "UPDATE playdates SET Response = 'Accepted' WHERE Inviter_name = '{$inviter}' && Play_date = '{$day}'";
			if (mysqli_query($conn, $query)) {
				echo '<script>console.log("Success");
				alert("Invitation accepted! Please feel free to contact ' . $inviter . ' by getting in touch on ph:' . $inviter_ph . '");
				location.href="http://localhost/ICTWEB517/invitations.php";</script>';
			} else {
				echo '<script>alert("Error");</script>';
			}
		}
        if(isset($_POST['resno'])) {
			if(isset($_POST['inviter']) || isset($_POST['date'])) {
            $inviter= $_POST['inviter'];
			$day= $_POST['date'];
			} else {
				echo '<script>alert("Something went wrongs!");</script>';
			}			
			$query= "UPDATE playdates SET Response = 'Declined' WHERE Inviter_name = '{$inviter}' && Play_date = '{$day}'";
			if (mysqli_query($conn, $query)) {
				echo '<script>console.log("Success");
				location.href="http://localhost/ICTWEB517/invitations.php";</script>';
			} else {
				echo '<script>alert("Error");</script>';
			}
        }
    ?>
	</table>
	<p style="color: #676667; text-align: center;font-size: 12px; padding: 30px;">*Please be aware that your name and number will be sent to the invitee upon acceptance of an invitation.</p>
	<h1>Invitations you have sent:</h1>
	<table id="invitestable">
		<?php
		$res2 = mysqli_query($conn, $inv);
		?>
		<tr>
		<th class="matchtable1">Who?</th>
		<th class="matchtable1">When?</th>
		<th class="matchtable1">Response</th>
		</tr>
		<?php
		while ($rows=mysqli_fetch_assoc($res2)) {
		?>
			<tr>
				<td class="matchtable1"><?php echo $rows['Invitee_name'];?></td>
				<td class="matchtable1"><?php echo $rows['Play_date'];?><br>at <?php echo $rows['F_Play_time'];?></td>
				<td class="matchtable1"><?php echo $rows['Response'];?>
				<?php 
				if ($rows['Response'] === 'Accepted') {
				?>
					<br>(<?php echo $rows['Invitee_name'];?>'s phone<br> no:<?php echo $rows['Invitee_ph'];?>)</td>	
				<?php
				} else if ($rows['Response'] === 'No Reply') {
				?>
					<br><input type="button" onclick="window.open('mailto:<?php echo $rows['Invitee_mail'];?>?subject=Invitation for a Puppy Play Date&body=Hi <?php echo $rows['Invitee_name'];?>!%0D%0A%0D%0AYour dog has recieved an invitation to play! Please login to your BetterPets Puppy Play Dates account to view details and respond (http://localhost/ICTWEB517/invitations.php).%0D%0A%0D%0ASincerely,%0D%0AThe BetterPets Team');" value="Send Email" /></td>	
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