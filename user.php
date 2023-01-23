<?php
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);
include "connect.php";

if (isset($_POST['first_name']) || isset($_POST['surname']) || isset($_POST['password']) || isset($_POST['phone']) ||
    isset($_POST['email']) || isset($_POST['suburb']) || isset($_POST['postcode']) || isset($_POST['dog_name']) ||
    isset($_POST['dog_breed']) || isset($_POST['dog_age']) || isset($_POST['dog_gender']) || isset($_POST['image'])) {
            $first_name = $_POST['first_name'];
            $surname = $_POST['surname'];
            $password = $_POST['password'];
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $phone = $_POST['phone'];
            $email = $_POST['e-mail'];
            $suburb = $_POST['suburb'];
            $postcode = $_POST['postcode'];
            $dog_name = $_POST['dog_name'];
            $dog_breed = $_POST['dog_breed'];
            $dog_age = $_POST['dog_age'];
            $dog_gender = $_POST['dog_gender'];
            $fileupload = $_FILES['image']['name'];
            $filetype = $_FILES['image']['type'];
            $filesize = $_FILES['image']['size'];
            $tempname = $_FILES['image']['tmp_name'];
            $filelocation = "userimages/$fileupload";
            if (!move_uploaded_file($tempname,$filelocation))
            {
              switch ($_FILES['prodImage']['error'])
              {
                case UPLOAD_ERR_INI_SIZE:
                echo "<p>Error: File exceeds the maximum size limit set by the server</p>" ;
                exit();
                break;
                case UPLOAD_ERR_FORM_SIZE:
                echo "<p>Error: File exceeds the maximum size limit set by the browser</p>" ;
                exit();
                break;
                case UPLOAD_ERR_NO_FILE:
                echo "<p>Error: No file uploaded</p>" ;
                exit();
                break;
                default:
                echo "<p>File could not be uploaded </p>" ;
                exit();
              }
            }
            
} else {
    echo '<script>console.log("Something went wrong!");</script>';
}
$query1 = "INSERT INTO user_info (User_Firstname, User_Surname, User_Password, Phone_no, Email, Suburb,
            Postcode, Dog_Name, Dog_Breed, Dog_Age, Dog_Gender, Dog_Image)
            VALUES ('$first_name', '$surname', '$hash', '$phone', '$email', '$suburb', '$postcode',
            '$dog_name', '$dog_breed', '$dog_age', '$dog_gender', '$filelocation')";
if (mysqli_query($conn, $query1)) {
    echo '<script>console.log("Success");
    alert("Success! Please use these details to log in");
    location.href="http://localhost:8888/BetterPets/homepage.php#mainimage";</script>';
} else {
    echo '<script>console.log("Error: " . mysqli_error($conn));
    location.href= "http://localhost:8888/BetterPets/homepage.php#mainimage"</script>';
}

?>