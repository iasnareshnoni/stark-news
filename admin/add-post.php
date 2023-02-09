<?php include "header.php";
include "config.php";
if (isset($_FILES['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
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

if(isset($_POST['submit'])){
$title = mysqli_real_escape_string($con, $_POST['post_title']);
$desc = mysqli_real_escape_string($con, $_POST['postdesc']);
$category = mysqli_real_escape_string($con, $_POST['category']);
$date =  date("d M, Y");
$author = $_SESSION['user_id'];

 $sql =  "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('$title','$desc','$category','$date','$author','$file_name');";
 $sql .= " UPDATE category SET post = post + 1 WHERE category_id = '$category'";


if(mysqli_multi_query($con, $sql)){
    header("location:post.php");
}else{
    echo "<div class = 'alert alert-danger'> Query Failed </div>";
}
}


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5"></textarea required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control" required>
                            <option value="" disabled selected> Select Category</option>
                            <?php
                            include "config.php";
                            $query = mysqli_query($con, "SELECT * FROM category");
                            if (mysqli_num_rows($query) > 0) {
                                while ($res = mysqli_fetch_assoc($query)) {
                            ?>
                                    <option value="<?php echo $res['category_id']; ?>"><?php echo $res['category_name']; ?></option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>