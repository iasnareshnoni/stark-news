<?php
$id = $_GET['delete'];

include "config.php";
$query = mysqli_query($con, "DELETE FROM user WHERE user_id = '$id' ");
if($query){
    header("location:users.php");
}else{
    header("location:users.php");
}

?>