<?php

include "connect.php";

$id = $_GET['ID'];
echo '<script>alert(' . $id . ');</script>';
$query = "DELETE FROM playdates WHERE ID = '{$id}'";
$del = mysqli_query($conn,$query);

if($del)
{
    mysqli_close($conn);
    header("location:invitations.php");
    exit;	
}
else
{
echo '<script>alert("error");</script>';
}
?>