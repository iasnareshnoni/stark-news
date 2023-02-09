<?php
include "config.php";
$id = $_GET['id'];
$cat_id = $_GET['catid'];

// Deleting image from upload file
$sql1 = "SELECT * FROM post WHERE post_id = $id";
$query1 = mysqli_query($con,$sql1) or die("Query Failed");
$row = mysqli_fetch_assoc($query1);
unlink("upload/" . $row['post_img']);

// Deleting post from database and update the post in category table
$sql = "DELETE FROM post WHERE post_id = $id;";
$sql .= " UPDATE category SET post = post-1 WHERE category_id = $cat_id ";

if(mysqli_multi_query($con, $sql)){
    header("location:post.php");
}else{
    header("location:post.php");
}
?>