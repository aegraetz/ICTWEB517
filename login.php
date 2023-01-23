<?php
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);
include "connect.php";

if (isset($_POST['e-mail']) || isset($_POST['password'])) {
			$loginemail = $_POST['e-mail'];
            $loginpassword = $_POST['password'];
} else {
    echo '<script>console.log("Something went wrong!");</script>';
}
$findpass = "SELECT User_Password FROM user_info WHERE Email = '{$loginemail}'";
$result = mysqli_query($conn, $findpass);
$row = mysqli_fetch_assoc($result);
$hash = $row['User_Password'];
$verify = password_verify($loginpassword, $hash);
if ($verify) {
	session_start();
	$ownerinfo = "SELECT * FROM user_info WHERE Email = '{$_SESSION["userid"]}'";
	$result = mysqli_query($conn, $ownerinfo);
	$row = mysqli_fetch_row($result);
	$ownername = $row[0];
	$phone = $row[3];
	$dogname = $row[7];
	$dogbreed = $row[8];
	$dogage = $row[9];
	$doggender = $row[10];
	$_SESSION["loggedin"] = true;
	$_SESSION["userid"] = $loginemail;
	$_SESSION["username"] = $ownername;
	$_SESSION["phone"] = $phone;
	$_SESSION["dogname"] = $dogname;
	$_SESSION["dogbreed"] = $dogbreed;
	$_SESSION["dogage"] = $dogage;
	$_SESSION["doggender"] = $doggender;
	echo '<script>console.log("Password verified");
	location.href= "http://localhost:8888/BetterPets/playdate.php";
	</script>';
} else {
	echo '<script>console.log("Incorrect password");</script>';
	mysqli_close($conn);
	echo '<script type="text/javascript">alert("Incorrect e-mail or password. Please try again or create an account");
	location.href= "http://localhost:8888/BetterPets/homepage.php";
	</script>';
}
?>