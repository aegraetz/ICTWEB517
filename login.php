<?php
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
	$_SESSION["loggedin"] = true;
	$_SESSION["userid"] = $loginemail;
	echo '<script>console.log("Password verified");
	location.href= "http://localhost:8888/BetterPets/playdate.php";
	</script>';
} else {
	echo '<script>console.log("Incorrect password");</script>';
	mysqli_close($conn);
	echo '<script type="text/javascript">alert("Incorrect e-mail or password. Please try again or create an account");
	location.href= "http://localhost:8888/BetterPets/homepage.html";
	</script>';
}
?>