<?php
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);
include "connect.php";
//if a response was set to accept the data in the database is changed to reflect this
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
//if a response was set to decline the data in the database is changed to reflect this
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