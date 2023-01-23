<?php
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);
include "connect.php";

session_start();
if (isset($_POST['date']) || isset($_POST['time']) || isset($_POST['id'])) {
			$play_date = $_POST['date'];
			$play_time = $_POST['time'];
			$invitee_no = $_POST['id'];
			$inviter = $_SESSION['username'];
			$inviter_no = $_SESSION['phone'];
} else {
	echo '<script>alert("Something went wrongs!");</script>';
}
$inviteeinfo = "SELECT User_Firstname FROM user_info WHERE Phone_no = '{$invitee_no}'";
$result = mysqli_query($conn, $inviteeinfo);
$row = mysqli_fetch_assoc($result);
$invitee = $row['User_Firstname'];
$date_created = date('d-m-y');
$response = "No Reply";
echo '<script>console.log(`'. $inviter . "\n" . $inviter_no. "\n" . $play_date . "\n" . $play_time . "\n" . $invitee . "\n" . $invitee_no . "\n" . $date_created .'`); </script>';
$query = "INSERT INTO playdates (Inviter_name, Inviter_no, Play_date, Play_time, Invitee_name,
			Invitee_no, Response, Date_created) VALUES ('$inviter', '$inviter_no', '$play_date',
			'$play_time', '$invitee', '$invitee_no', '$response', '$date_created')";
if (mysqli_query($conn, $query)) {
    echo '<script>console.log("Success");
    alert("Success! An invitation has been sent. Check back for a response.");
    location.href="http://localhost:8888/BetterPets/playdate.php";</script>';
} else {
    echo '<script>alert("Error");
    location.href= "http://localhost:8888/BetterPets/playdate.php"</script>';
}
mysqli_close($conn);
?>