<?php
include "config.php";

if(empty($_FILES['new-image']['name'])){
     $file_name = $_POST['old-image'];
}else{
    $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extension = array("jpeg", "jpg", "png","webp");

    if (in_array($file_ext, $extension) === false) {
        $errors[] = "file should be jpg, png, jpeg only";
    }
    if ($file_size > 2097152) {
        $errors[] = "File should be lower than 2MB";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        print_r($errors);
        die();
    }
}

$sql = "UPDATE post SET title='{$_POST['post_title']}', description='{$_POST['postdesc']}', category={$_POST['category']}, post_img='{$file_name}' WHERE post_id = {$_POST['post_id']}";

$query = mysqli_query($con, $sql);
if($query){
    header("location:post.php");
}else{
    header("location:update-post.php");
}

?>