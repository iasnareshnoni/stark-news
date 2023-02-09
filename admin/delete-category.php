<?php
$id = $_GET['delete'];

include "config.php";
$query = mysqli_query($con, "DELETE FROM category WHERE category_id = '$id' ");
if($query){
    header("location:category.php");
}else{
    header("location: category.php");
}
?>