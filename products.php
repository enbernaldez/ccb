<?php

include_once "db_conn.php";

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
$_SESSION['location'] = "products";
$loc = $_SESSION['location'];

?>

<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Chew Chew Bakeshop</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" href="ccb.css">
        <style type="text/css">
            .img-wrap {
                height: 137px;
                width: 100px;
                font-size: 14px;
                background-color: #F5E1B9;
            }
            .img-descr {
                bottom: 21px;
            }
            .img-wrap img {
                width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
    <!--Navigation Bar-->
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <div class="row">
                <div class="col-8">
                    <!--Best Sellers-->
                    <div class="container my-5">
                        <h4 class="header">Best Sellers</h4>
                        <div class="row category" style="background-color:#E5825F">
                            <?php
                            $sql = "SELECT i.item_id, i.item_name, i.item_imgdir, i.item_price, COUNT(o.item_id) AS order_ct FROM `orders` o JOIN items i on o.item_id = i.item_id WHERE i.item_status = 'A' GROUP BY i.item_name ORDER BY COUNT(o.item_id) DESC";
                            $result = mysqli_query($conn, $sql);
                            for($i = 0; $i < 6; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $item_id = $row['item_id'];
                                $item_name = $row['item_name'];
                                $item_imgdir = $row['item_imgdir'];
                                $item_price = $row['item_price'];
                                $order_ct = $row['order_ct'];
                            ?>
                            <div class="col-2">
                                <div class="img-wrap">
                                    <img src="<?php echo $item_imgdir ?>" alt="<?php echo $item_name ?>"/>
                                    <p class="img-descr"><?php echo $item_name . "<br>₱" . $item_price ?></p>
                                    
                                    <form action="add_to_cart.php" method="post">
                                        <div class="input-group">
                                            <input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>">
                                            <input type="number" class="form-control quantity" id="cart_qty" required name="cart_qty" value="1" min="1">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn button" >
                                                    <i class="bi-cart-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--display products of each-->
                    <?php
                    $sql_cat = "SELECT * FROM `category`";
                    $result_cat = query($conn, $sql_cat);
                    foreach($result_cat as $key => $row)
                    {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                    ?>
                    <div class="container my-5">
                        <h4 class="header"><?php echo $category_name ?></h4>
                        <div class="row category">
                            <?php
                            $sql = "SELECT item_id, item_name, item_imgdir, item_price FROM `items` WHERE category_id = $category_id && item_Status = 'A' GROUP BY item_id, item_name, item_imgdir, item_price;";
                            $result = query($conn, $sql);
                            foreach($result as $key => $row) {
                                $item_id = $row['item_id'];
                                $item_name = $row['item_name'];
                                $item_imgdir = $row['item_imgdir'];
                                $item_price = $row['item_price'];
                            ?>
                            <div class="col-2 center">
                                <!--display img with descr and buttons-->
                                <div class="img-wrap">
                                    <img src="<?php echo $item_imgdir ?>" alt="<?php echo $item_name ?>"/>
                                    <p class="img-descr"><?php echo $item_name . "<br>₱" . $item_price ?></p>
                                    
                                    <form action="add_to_cart.php" method="post">
                                        <div class="input-group">
                                            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                                            <input type="number" class="form-control quantity" id="cart_qty" required name="cart_qty" value="1" min="1">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn button" >
                                                    <i class="bi-cart-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!--cart section-->
                <div class="col-4">
                    <div class="container my-5">
                        <form action="cart_action.php" method="post">
                            <h4 class="header">Cart</h4>
                            <?php   
                            $list = '';
                            echo display_tables($conn, $user_id, 'C', $list, $loc); 
                            ?>
                        </form>
                    </div>
                </div>                         
            </div>
        </div>
        
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>
