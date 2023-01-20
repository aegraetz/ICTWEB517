<?php
/*$query = "CREATE TABLE IF NOT EXISTS playdates (
	inviter_name VARCHAR(45) NOT NULL,
	inviter_no INT(10) PRIMARY KEY NOT NULL,
	play_date DATE(10) NOT NULL,
	play_time TIME(5) NOT NULL,
	invitee_name VARCHAR(45) NOT NULL,
	invitee_no INT(10) NOT NULL,
	response VARCHAR(3),
	date_created DATE(10) NOT NULL)";
	if (!mysqli_query($query)) {
		  echo '<script>console.log("table2 query failed") . mysqli_error($conn);</script>';
		} else {
		  echo '<script>console.log("successful table2 creation"); </script>';
		}*/
include "connect.php";

if (isset($_POST['date']) || isset($_POST['time']) || isset($_POST['id']) ||
	isset($_POST['inviter']) || isset($_POST['inviter_no'])) {
			$date = $_POST['date'];
			$time = $_POST['time'];
			$id = $_POST['id'];
			$inviter = $_POST['inviter'];
			$inviter_no = $_POST['inviter_no'];
} else {
	echo '<script>console.log("Something went wrong!");</script>';
}
$inviteeinfo = "SELECT User_Firstname FROM user_info WHERE Phone_no = '{$_SESSION['$id']}'";
$result = mysqli_query($conn, $inviteeinfo);
$row = mysqli_fetch_row($result);
$invitee = $row[0];
$date_created = date('d-m-y');
$query = "INSERT INTO playdates (inviter_name, inviter_no, play_date, play_time, invitee_name,
			invitee_no, response, date_created) VALUES ('$inviter', '$inviter_no', '$date',
			'$time', '$invitee', '$id', NULL, '$date_created')";
if (mysqli_query($conn, $query)) {
    echo '<script>console.log("Success");
    alert("Success! An invitation has been sent. Check back for a response.");
    location.href="http://localhost:8888/BetterPets/playdate.php";</script>';
} else {
    echo '<script>console.log("Error");
    location.href= "http://localhost:8888/BetterPets/playdate.php"</script>';
}
mysqli_close($conn);
?>