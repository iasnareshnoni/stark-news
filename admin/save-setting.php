<?php
include "config.php";

if(empty($_FILES['logo']['name'])){
     $file_name = $_POST['old-logo'];
}else{
    $errors = array();
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extension = array("jpeg", "jpg", "png","webp");

    if (in_array($file_ext, $extension) === false) {
        $errors[] = "file should be jpg, png, jpeg only";
    }
    if ($file_size > 2097152) {
        $errors[] = "File should be lower than 2MB";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
    } else {
        print_r($errors);
        die();
    }
}

$sql = "UPDATE settings SET website_name ='{$_POST['website_name']}', logo ='{$file_name}', footer_desc ='{$_POST['footer_desc']}'";

$query = mysqli_query($con, $sql);
if($query){
    header("location:settings.php");
}else{
    header("location:settings.php");
}

?>