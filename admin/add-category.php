<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
    header("location:post.php");
}
include "config.php";
$msg = "";

if(isset($_POST['save'])){
    $cate_name = mysqli_real_escape_string($con, $_POST['cat']);

    $query = mysqli_query($con, "SELECT * FROM category WHERE category_name = '$cate_name'");
    if(mysqli_num_rows($query) > 0){
        $msg = "This category is Already Exist";
        header("location:category.php");
    }else{
        $query2 = mysqli_query($con, "INSERT INTO category (category_name) VALUES('$cate_name')");
        if($query2){
           header("location:category.php");
        }else{
            header("location:add-category.php");
            $msg = "Not Inserted";
        }
    }

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <?php echo $msg; ?><br>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
