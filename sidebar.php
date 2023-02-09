<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include "config.php";
        $limit = 4;
        
        $sql = "SELECT * FROM post
                 LEFT JOIN category on post.category = category.category_id
                 ORDER BY post_id DESC
                 LIMIT $limit";
        $query = mysqli_query($con,$sql) or die("recents post query failed");
        if(mysqli_num_rows($query) > 0){
            while($res = mysqli_fetch_assoc($query)){
          ?>
           <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $res['post_id']; ?>">
                <img src="admin/upload/<?php echo $res['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $res['post_id']; ?>"><?php echo $res['title']; ?></a></h5>
                <span>_
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?id=<?php echo $res['category_id']; ?>'><?php echo $res['category_name']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $res['post_date']; ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $res['post_id']; ?>">read more</a>
            </div>
        </div>
          <?php
            }
        }
        ?>
    </div>
    <!-- /recent posts box -->
</div>
