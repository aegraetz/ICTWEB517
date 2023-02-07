<?php
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);
include "connect.php";
//adding a playdate invitation to the playdates table in the database
session_start();
if (isset($_POST['date']) || isset($_POST['time']) || isset($_POST['id'])) {
			$play_date = $_POST['date'];
			$play_time = $_POST['time'];
			$invitee_no = $_POST['id'];
			$inviter = $_SESSION['username'];
			$inviter_no = $_SESSION['phone'];
			$inviter_dog = $_SESSION['dogname'];
} else {
	echo '<script>alert("Something went wrong!");</script>';
}
$inviteeinfo = "SELECT User_Firstname, Email FROM user_info WHERE Phone_no = '{$invitee_no}'";
$result = mysqli_query($conn, $inviteeinfo);
$row = mysqli_fetch_assoc($result);
$invitee = $row['User_Firstname'];
$email = $row['Email'];
$date_created = date('d-m-y');
$response = "No Reply";
$query = "INSERT INTO playdates (Inviter_name, Inviter_no, Play_date, Play_time, Invitee_name,
			Invitee_no, Invitee_mail, Response, Date_created, Inviter_dog) VALUES ('$inviter', '$inviter_no', '$play_date',
			'$play_time', '$invitee', '$invitee_no', '$email', '$response', '$date_created', '$inviter_dog')";
if (mysqli_query($conn, $query)) {
    echo '<script>console.log("Success");
    alert("Success! Invitation has been booked, please continue to the invitations page and press the send email button to notify your play date.");
    location.href= "http://localhost/ICTWEB517/invitations.php"</script>';
} else {
    echo '<script>alert("Error");
    location.href= "http://localhost/ICTWEB517/invitations.php"</script>';
}
?>