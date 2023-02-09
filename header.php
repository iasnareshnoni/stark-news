<?php
include "config.php";
$page = basename($_SERVER['PHP_SELF']);

switch($page){
   case "single.php":
    if(isset($_GET['id'])){
       $sql_title = "SELECT * FROM post WHERE post_id = '{$_GET['id']}'";
       $query_title = mysqli_query($con,$sql_title) or die("title query failed");
       $result_title = mysqli_fetch_assoc($query_title);
       $page_title = $result_title['title'];
    }else{
        $page_title = "No Post found";
    }
    break;
    case "category.php":
        if(isset($_GET['id'])){
            $sql_title = "SELECT * FROM category WHERE category_id = '{$_GET['id']}'";
            $query_title = mysqli_query($con,$sql_title) or die("title query failed");
            $result_title = mysqli_fetch_assoc($query_title);
            $page_title = $result_title['category_name']. " News";
         }else{
             $page_title = "No Post found";
         }
    break;
    case "author.php":
        if(isset($_GET['id'])){
            $sql_title = "SELECT * FROM user WHERE user_id = '{$_GET['id']}'";
            $query_title = mysqli_query($con,$sql_title) or die("title query failed");
            $result_title = mysqli_fetch_assoc($query_title);
            $page_title = "News By ".$result_title['first_name'] . $result_title['last_name'];
         }else{
             $page_title = "No Post found";
         }
    break;
    case "search.php":
        if(isset($_GET['search'])){
            $page_title = $_GET['search'];
         }else{
             $page_title = "No search Result found";
         }
    break;
    default:
    $page_title = "news-site";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <?php
            include "config.php";
            $sql = "SELECT * FROM settings";
            $query = mysqli_query($con,$sql);
            $res = mysqli_fetch_assoc($query);
            ?>
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $res['logo']; ?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                <li><a href="index.php">Home</a></li>
                    <?php
                    
                    include "config.php";
                     if(isset($_GET['id'])){
                        $cat_id = $_GET['id'];
                     }
                    
                    $sql = "SELECT * FROM category WHERE post > 0";
                    $query = mysqli_query($con,$sql);
                    if(mysqli_num_rows($query) > 0){
                        $active = "";
                        while($res = mysqli_fetch_assoc($query)){
                            if(isset($_GET['id'])){ 
                          if($res['category_id'] == $cat_id){
                              $active = "active";
                          }else{
                            $active = "";
                          }
                        }
                    ?>
                    <li><a class="<?php echo $active; ?>" href='category.php?id=<?php echo $res['category_id']; ?>'><?php echo $res['category_name']; ?></a></li>

                    <?php
                             }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
