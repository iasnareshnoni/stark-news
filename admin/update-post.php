<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->

        <?php  
        include "config.php";

        $post_id = $_GET['id'];

        $sql = "SELECT * FROM post
        LEFT JOIN category on post.category = category.category_id
        LEFT JOIN user on post.author = user.user_id
        WHERE post.post_id = $post_id";
        // echo $sql; 
        $query = mysqli_query($con,$sql);
        if(mysqli_num_rows($query) > 0){
            while($res = mysqli_fetch_assoc($query)){
        ?>

        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $res['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $res['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
     <?php echo $res['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <?php
                            include "config.php";
                            $query = mysqli_query($con, "SELECT * FROM category");
                            if (mysqli_num_rows($query) > 0) {
                                while ($res1 = mysqli_fetch_assoc($query)) {
                                    if($res['category'] == $res1['category_id']){
                                        $select = "Selected";
                                    }else{
                                        $select = "";
                                    }
                            ?>
                                    <option <?php echo $select; ?> value="<?php echo $res1['category_id']; ?>"><?php echo $res1['category_name']; ?></option>
                            <?php
                                }
                            }
                            ?>

                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $res['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $res['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php
            }
        }else{
            echo "Result Not found";
        }
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
