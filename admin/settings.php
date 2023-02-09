<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
            <?php  
        include "config.php";

        $sql = "SELECT * FROM settings"; 
        $query = mysqli_query($con,$sql);
        if(mysqli_num_rows($query) > 0){
            while($res = mysqli_fetch_assoc($query)){
        ?>
                <!-- Form -->
                <form action="save-setting.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="website_name">Website Name</label>
                        <input type="text" name="website_name" value="<?php echo $res['website_name']; ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo Website</label>
                        <input type="file" name="logo" required>
                        <img  src="images/<?php echo $res['logo']; ?>">
                        <input type="hidden" name="old-logo" value="<?php echo $res['logo']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="footer_desc">Footer Description</label>
                        <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $res['footer_desc']; ?></textarea>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <?php
                }
            }?>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>