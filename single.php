<?php include 'header.php';
include "config.php";

$id = $_GET['id'];
$sql = "SELECT * FROM post
LEFT JOIN category on post.category = category.category_id
LEFT JOIN user on post.author = user.user_id
WHERE post_id = $id";

$query = mysqli_query($con,$sql);
if(mysqli_num_rows($query) > 0){
 while($res = mysqli_fetch_assoc($query)){
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $res['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $res['category_name']; ?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?id=<?php echo $res['user_id']; ?>'><?php echo $res['first_name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $res['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $res['post_img']; ?>" alt=""/>
                            <p class="description">
                            <?php echo $res['description']; ?>
                        </p>
                        </div>
                    </div>
                    <?php
                        
                    }
                   }else{
                       echo "<h2>Not Record Found</h2>";
                   }
                   ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
