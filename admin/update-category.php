<?php include "header.php";
if($_SESSION['user_role'] == 0){
    header("location:post.php");
}

include "config.php";
$msg = "";

$id = $_GET['update'];
$query = mysqli_query($con, "SELECT * FROM category WHERE category_id = '$id'");

if(isset($_POST['submit'])){
    $idupdate = mysqli_real_escape_string($con,$_POST['cat_id']);
    $cate_name = mysqli_real_escape_string($con,$_POST['cat_name']);

     $query2 = mysqli_query($con, "UPDATE category SET category_name = '$cate_name' WHERE category_id = $idupdate");
    if($query2){
        header("location:category.php");
    }else{
        $msg = "Not Update";
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>

              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST">

                  <?php
                  while($res = mysqli_fetch_assoc($query)){
                  
                  ?>
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $res['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $res['category_name']; ?>"  placeholder="" required>
                      </div>
                      <?php echo $msg; ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php
                  }                      
                      ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>