<div id ="footer">
    <div class="container">
        <div class="row">
        <?php
            include "config.php";
            $sql = "SELECT * FROM settings";
            $query = mysqli_query($con,$sql);
            $res = mysqli_fetch_assoc($query);
            ?>
            <div class="col-md-12">
                <span><?php echo $res['footer_desc']; ?><a href=""></a></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
