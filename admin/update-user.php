<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
    header("location:post.php");
}
include "config.php";

$id = $_GET['update'];
$msg = "";

$query = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$id'");


if(isset($_POST['update'])){
    $update_id = mysqli_escape_string($con, $_POST['user_id']);
    $fname = mysqli_escape_string($con, $_POST['f_name']);
    $lname = mysqli_escape_string($con, $_POST['l_name']);
    $user = mysqli_escape_string($con, $_POST['username']);
    $role = mysqli_escape_string($con, $_POST['role']);
    
        $sql = "UPDATE user SET first_name = '$fname' , last_name = '$lname', username = '$user', role = '$role' WHERE user_id = $update_id";
        $query = mysqli_query($con,$sql);
        if($query){
             $msg = "UPDATED";
             header("location:users.php");
        }else{
            $msg = "NOT UPDATED";
        }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST">

                <?php

                    while($res = mysqli_fetch_assoc($query)){

                ?>
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $res['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $res['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $res['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $res['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $res['role']; ?>">
                              <option value="0">normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <?php echo $msg; ?>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                      <?php
               }
                    ?>
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
