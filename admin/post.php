<?php include "header.php";?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        include "config.php";

                        $limit = 3;
                        if(isset($_GET['pages'])){
                            $pages = $_GET['pages'];
                        }else{
                            $pages = 1;
                        }
                        
                        $offset = ($pages - 1)* $limit;
                        
                        if($_SESSION['user_role'] == 1){
                            $sql = "SELECT * FROM post
                            LEFT JOIN category on post.category = category.category_id
                            LEFT JOIN user on post.author = user.user_id
                            ORDER BY post.post_id DESC
                            LIMIT $offset,$limit";
                        }elseif($_SESSION['user_role'] == 0){
                            $sql = "SELECT * FROM post
                            LEFT JOIN category on post.category = category.category_id
                            LEFT JOIN user on post.author = user.user_id
                            WHERE post.author = {$_SESSION['user_id']}
                            ORDER BY post.post_id DESC
                            LIMIT $offset,$limit";
                        }
                        
                        
                        $query = mysqli_query($con,$sql);
                        if(mysqli_num_rows($query) > 0){
                        while($res = mysqli_fetch_assoc($query)){ ?>
                          <tr>
                              <td class='id'><?php echo $res['post_id']; ?></td>
                              <td><?php echo $res['title']; ?></td>
                              <td><?php echo $res['category_name']; ?></td>
                              <td><?php echo $res['post_date']; ?></td>
                              <td><?php echo $res['username']; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $res['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $res['post_id']; ?>&catid=<?php echo $res['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php }
                          }
                          ?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                    <?php 
                    $sql2 = "SELECT * FROM post";
                    $query2 = mysqli_query($con,$sql2);
                    if(mysqli_num_rows($query2) > 0){
                        $total_records = mysqli_num_rows($query2);
                        
                        $total_pages = ceil($total_records/$limit);

                        for($i = 1; $i <= $total_pages; $i++){
                           ?>
                            <li><a href="post.php?pages=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                           <?php
                        }
                    }
                    ?>
                    

                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
