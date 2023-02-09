<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                      <?php
                      
                      include "config.php";
                      
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
                                        <?php echo substr($res['description'], 0, 80) . "..."; ?>
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
                            <li><a href="index.php?pages=<?php echo ($pages - 1); ?>">Prev</a></li>
                      <?php 
                       }   
                    $sql2 = "SELECT * FROM post";
                    $query2 = mysqli_query($con,$sql2);
                    if(mysqli_num_rows($query2) > 0){
                        $total_records = mysqli_num_rows($query2);
                        
                        $total_pages = ceil($total_records/$limit);

                        for($i = 1; $i <= $total_pages; $i++){
                            if($i == $pages){
                                $active = "active";
                              }else{
                                  $active = "";
                              }
                           ?>
                            <li class="<?php echo $active; ?>"><a href="index.php?pages=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                           <?php
                        }
                    }
                    if($total_pages > $pages){
                    ?>
                    <li><a href="index.php?pages=<?php echo ($pages + 1); ?>">Next</a></li>
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
