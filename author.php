<?php include 'header.php';
 include "config.php";
 $user_id = $_GET['id'];   
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                        $query2 = mysqli_query($con, "SELECT * FROM user WHERE user_id = $user_id");
                        if(mysqli_num_rows($query) > 0){
                            $result = mysqli_fetch_assoc($query2);
                            ?>
                      <h2 class="page-heading"><?php echo $result['first_name'] ." ". $result['last_name']; ?></h2>
                      <?php
                        }
                    
                      $limit = 3;
                        if(isset($_GET['pages'])){
                            $pages = $_GET['pages'];
                        }else{
                            $pages = 1;
                        }
                        
                        $offset = ($pages - 1)* $limit;
                        $sql = "SELECT * FROM post
                            LEFT JOIN category on post.category = category.category_id
                            LEFT JOIN user on post.author = user.user_id
                            WHERE author = $user_id
                            ORDER BY post.post_id DESC
                            LIMIT $offset,$limit";

                                $query = mysqli_query($con,$sql);
                                if(mysqli_num_rows($query) > 0){
                                while($res = mysqli_fetch_assoc($query)){
                      ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $res['post_id']; ?>"><img src="admin/upload/<?php echo $res['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $res['post_id']; ?>'><?php echo $res['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?id=<?php echo $res['category_id']; ?>'><?php echo $res['category_name']; ?></a>
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
                                    <p class="description">
                                    <?php echo substr($res['description'], 0, 50); ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $res['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        
                    }
                   }else{
                       echo "<h2>Not Record Found</h2>";
                   }
                   ?>
                    <ul class='pagination'>
                      <?php  
                        if($pages > 1){ 
                       ?>
                            <li><a href="author.php?pages=<?php echo ($pages - 1); ?>&id=<?php echo $user_id; ?>">Prev</a></li>
                      <?php 
                       }  
                    $sql3 = "SELECT * FROM post
                    LEFT JOIN category on post.category = category.category_id
                    LEFT JOIN user on post.author = user.user_id
                    WHERE author = '$user_id'";
                    $query3 = mysqli_query($con,$sql3);
                    if(mysqli_num_rows($query3) > 0){
                        $total_records = mysqli_num_rows($query3);
                        $total_pages = ceil($total_records/$limit);
                        for($i = 1; $i <= $total_pages; $i++){
                            if($i == $pages){
                              $active = "active";
                            }else{
                                $active = "";
                            }
                           ?>
                            <li class="<?php echo $active; ?>"><a href="author.php?pages=<?php echo $i; ?>&id=<?php echo $user_id; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                    }
                       if($total_pages > $pages){ 
                    ?>
                        <li><a href="author.php?pages=<?php echo ($pages + 1); ?>&id=<?php echo $user_id; ?>">Next</a></li>
                    <?php 
                       }  
                    ?>
                    
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
