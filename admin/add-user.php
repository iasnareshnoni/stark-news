<?php include "header.php";

if($_SESSION['user_role'] == 0){
    header("location:post.php");
}
$msg = "";

include "config.php";


if(isset($_POST['save'])){
    $fname = mysqli_escape_string($con, $_POST['fname']);
    $lname = mysqli_escape_string($con, $_POST['lname']);
    $user = mysqli_escape_string($con, $_POST['user']);
    $password = mysqli_escape_string($con, $_POST['password']);
    $role = mysqli_escape_string($con, $_POST['role']);
    
    $select = "SELECT * FROM user WHERE username = '$user'";
    $select_query = mysqli_query($con,$select);
    if(mysqli_num_rows($select_query) > 0){
        $msg = "User Already Exists";
    }else{
        $sql = "INSERT INTO user (first_name,last_name,username,password,role) VALUES('$fname','$lname','$user','$password','$role')";
        $query = mysqli_query($con,$sql);
        if($sql){
             $msg = "INSERTED";
             header("location:users.php");
        }else{
            $msg = "NOT INSERTED";
        }
    }
}



?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <?php echo $msg; ?><br>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required /><br>
                      
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>

