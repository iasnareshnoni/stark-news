<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
    header("location:post.php");
}

include "config.php";
$limit = 3;
if(isset($_GET['pages'])){
    $page = $_GET['pages'];
}else{
    $page = 1;
}
$offset = ($page - 1)*$limit;

$query = mysqli_query($con, "SELECT * FROM category LIMIT $offset,$limit");
if(mysqli_num_rows($query) > 0){

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php

                        while( $res = mysqli_fetch_assoc($query)){

                        ?>
                        <tr>
                            <td class='id'><?php echo $res['category_id'];?></td>
                            <td><?php echo $res['category_name'];?></td>
                            <td><?php echo $res['post'];?></td>
                            <td class='edit'><a href='update-category.php?update=<?php echo $res['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?delete=<?php echo $res['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                        }
                            }else{
                                $msg = "No Record Found";
                            }
                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                <?php
                
                $query1 = mysqli_query($con, "SELECT * FROM category");
                if(mysqli_num_rows($query1) > 0){
                    $total_records = mysqli_num_rows($query1);
                   
                    $total_page = ceil($total_records/$limit);
                    for($i = 1; $i <= $total_page; $i++){
                    ?>
                         <li><a href="category.php?pages=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php

                    }
                }
                
                ?>
               
                    <!-- <li class="active"><a>1</a></li> -->
                   
                    <!-- <li><a>3</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
