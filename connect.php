<?php

$conn = mysqli_connect("localhost", "root", "root");
if (!$conn) {
  echo "The connection has failed" . mysqli_error($conn);
}
else {
  $dbName ="betterpets";
  $query = "CREATE DATABASE IF NOT EXISTS ". $dbName;
  if (!mysqli_query($conn, $query))
  {
    echo "Could not open the database" . mysqli_error($conn);
  }
  else
  {
    if (!mysqli_select_db($conn, $dbName))
    {
      echo '<script>console.log("Could not open the database") . mysqli_error($conn); </script>';
    }
    else
    {
    echo '<script>console.log("Database created successfully");</script>';
    $query = "CREATE TABLE IF NOT EXISTS user_info (
      User_Firstname VARCHAR(45) NOT NULL,
      User_Surname VARCHAR(45) NOT NULL,
      User_Password VARCHAR(255) NOT NULL,
      Phone_no INT(10) PRIMARY KEY NOT NULL,
      Email VARCHAR(45) NOT NULL,
      Suburb VARCHAR(45) NOT NULL,
      Postcode INT(4) NOT NULL,
      Dog_Name VARCHAR(45) NOT NULL,
      Dog_Breed VARCHAR(45) NOT NULL,
      Dog_Age INT(2) NOT NULL,
      Dog_Gender VARCHAR(6) NOT NULL,
      Dog_Image VARCHAR(100) NOT NULL)";
      if (!mysqli_query($conn, $query))
      {
        echo '<script>console.log("table query failed") . mysqli_error($conn);</script>';
      } else {
        echo '<script>console.log("successful table creation"); </script>';
      }
    }
  }
}
?>