<?php include 'header.php'; 
if(isset($_GET['search'])){
    $s_id = $_GET['search'];
}
$limit = 3;
if(isset($_GET['pages'])){
     $pages = $_GET['pages'];
}else{
    $pages = 1;
}
$offset = ($pages - 1)*$limit;
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $s_id; ?></h2>
                  <?php
                  include "config.php";
                  $sql = "SELECT * FROM post 
                  LEFT JOIN category on post.category = category.category_id
                  LEFT JOIN user on post.author = user.user_id
                  WHERE title LIKE '%$s_id%' OR description LIKE  '%$s_id%'
                  ORDER BY post DESC
                  LIMIT $offset,$limit";
                  $query = mysqli_query($con,$sql);
                  if(mysqli_num_rows($query) > 0){
                    foreach($query as $res){
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
                                    <?php echo substr($res['description'],0,100); ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $res['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                  }
                  ?>
                    <ul class='pagination'>
                    <?php  
                        if($pages > 1){ 
                       ?>
                            <li><a href="search.php?pages=<?php echo ($pages - 1); ?>&search=<?php echo $s_id; ?>">Prev</a></li>
                      <?php 
                       }                        
                      $sql2 = "SELECT * FROM post WHERE title LIKE '%$s_id%' OR description LIKE  '%$s_id%'";
                      $query2 = mysqli_query($con,$sql2);
                      if(mysqli_num_rows($query2) > 0){
                        $total_post = mysqli_num_rows($query2);
                        // $limit = 3;  This is use on top
                        $total_pages = ceil($total_post/$limit);
                        for($i = 1; $i <= $total_pages; $i++){
                            if($i == $pages){
                                $active = "active";
                              }else{
                                  $active = "";
                              }
                    ?>
                    <li class="<?php echo $active; ?>"><a href="search.php?pages=<?php echo $i; ?>&search=<?php echo $s_id; ?>"><?php echo $i; ?></a></li>
                    <?php
                        }  
                      }
                      if($total_pages > $pages){
                    ?>
                    <li><a href="search.php?pages=<?php echo ($pages + 1); ?>&search=<?php echo $s_id; ?>">Next</a></li>
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
