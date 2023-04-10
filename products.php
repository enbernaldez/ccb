<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Chew Chew Bakeshop</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <style type="text/css">
            .navbar {
                background-color: #311C09;
                overflow: hidden;
                position: fixed;
                width: 100%;
                z-index: 1;
            }
            .navbar a {
                color: #FF8E7B;
                font-family: Times New Roman;
                font-style: italic;
                text-decoration: none;
                font-size: 20px;
            }
            .navbar a:hover {
                color: #FEC7BE;
            }
            .add-shadow {
                box-shadow: 0px 1px 10px black;
            }
            body {
                background-image: url("pics\\website_bg.png");
                background-size: cover;
                background-repeat: no-repeat;
            }
            .img-wrap {
                position: relative;
                height: 137px;
                width: 100px;
                font-size: 14px;
                background-color: #F5E1B9;
            }
            .img-descr {
                position: absolute;
                top: 0;
                bottom: 21px;
                left: 0;
                right: 0;
                overflow: hidden;
                background-color: rgba(200, 100, 100, 0.70);
                color: #fff;
                padding-left: 5px;
                padding-right: 5px;
                visibility: hidden;
                opacity: 0;
                transition: opacity .2s, visibility .2s;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .img-wrap:hover .img-descr {
                visibility: visible;
                opacity: 1;
            }
            .header {
                font-family: Georgia;
                font-style: italic;
                font-weight: bold;
                color: black;
                margin-top: 25px;
            }
            .button {
                padding: 0 2px;
                margin: 7px 7px 0 8px;
                color: #311C09;
                font-family: Candara;
                font-size: 14px;
            }
            .modal-btn {
                padding: 2px 7px;
                margin-top: 1px;
                color: #311C09;
                font-family: Candara;
                background-color: #FF8E7B;
                border-radius: 5px;
            }
            .vl {
                border-right: 1px solid #311C09;
                height: 25px;
                left: 29%;
                position: absolute;
                margin-top: 7px;
            }
            .category {
                height= 200px;
                background-color: #E5A05F;
                border-radius: 20px;
                padding: 20px 20px 20px 10px;
                height: 180px;
                overflow: hidden;
            }
            .category img {
                width: 110px;
                height: 110px;
            }
            .icon {
                border: none;
                background: none;
            }
            .img-wrap img {
                width: 100%;
                height: auto;
            }
            .quantity {
                width: 100%;
                background: none;
                border-right-style: solid;
                border-right-width: 1px;
                border-right-color: #311C09;
                color: #311C09;
                text-align: center;
            }
            .smtxt {
                font-size: 12px;
                font-weight: normal;
            }
            .dftxt {
                font-size: 16px;
                font-weight: normal;
            }
        </style>
    </head>
    <body>
    <!--Navigation Bar-->
        <nav class="navbar">
            <div class="container">
                <a class="active" href="landing_page.php">
                    <img src="pics\CCB Logo.png" width="50px" height="50px"/>
                    Chew Chew Bakeshop
                </a>
                <li>
                    <a class="mx-5" href="products.php">Products</a>
                    <a href=""><?php echo $_SESSION['username'] ?></a>
                </li>
            </div>
        </nav>
        
        <div class="container pt-5">
            <div class="row">
                <div class="col-8">
                    <!--Best Sellers-->
                    <div class="container my-5">
                        <h4 class="header">Best Sellers</h4>
                        <div class="row category" style="background-color:#E5825F">
                            <?php
                            $sql = "SELECT i.item_id, i.item_name, i.item_imgdir, i.item_price, COUNT(i.item_id) AS order_ct FROM `orders` o JOIN items i on o.item_id = i.item_id GROUP BY i.item_name ORDER BY COUNT(O.item_id) DESC";
                            $result = mysqli_query($conn, $sql);
                            for($i = 0; $i < 6; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $item_name = $row['item_name'];
                                $item_imgdir = $row['item_imgdir'];
                                $item_price = $row['item_price'];
                                $order_ct = $row['order_ct'];
                            ?>
                            <div class="col-2">
                                <div class="img-wrap">
                                    <img src="<?php echo $item_imgdir ?>" alt="<?php echo $item_name ?>"/>
                                    <p class="img-descr"><?php echo $item_name ?><br><?php echo "₱" . $item_price ?></p>
                                    
                                    <form action="add_to_cart.php" method="post">
                                        <div class="input-group">
                                            <input type="number" class="form-control quantity" id="order_qty" required name="order_qty" value="1" min="1">
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
                            $sql = "SELECT item_id, item_name, item_imgdir, item_price FROM `items` WHERE category_id = $category_id GROUP BY item_id, item_name, item_imgdir, item_price;";
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
                                    <p class="img-descr"><?php echo $item_name ?><br><?php echo "₱" . $item_price ?></p>

                                    <div class="btn-group" role="button">
                                        <button type="button" class="btn button" data-toggle="modal" data-target="#add_to_cart<?php echo $item_id; ?>">
                                            <i class="bi-cart-fill"></i>
                                        </button>
                                        <div class="vl"></div>
                                        <button type="button" class="btn button" data-toggle="modal" data-target="#buy_now<?php echo $item_id; ?>">
                                            Buy Now
                                        </button>
                                    </div>
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
                        <form action="checkout.php" method="post">
                            <h4 class="header">Cart</h4>
                            <?php
                            echo "<table class='table table-bordered'>";

                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT i.item_id, i.item_imgdir, i.item_name, i.item_price, o.order_qty FROM orders o JOIN items i ON o.item_id = i.item_id WHERE o.user_id = $user_id";
                            $result = query($conn, $sql);

                            foreach($result as $key => $row) {
                                $item_id = $row['item_id'];
                                $item_imgdir = $row['item_imgdir'];
                                $item_name = $row['item_name'];
                                $item_price = $row['item_price'];
                                $order_qty = $row['order_qty'];

                                echo "<tr valign='middle'>";
                                    $product = $item_price * $order_qty;
                                    $cost = number_format($product, 2, '.', ',');
                                    echo "<td><input type='checkbox' class='checkbox' onchange='handleChange(this);' id='order" . $item_id . "' name='order' value='" . $cost . "'></td>";
                                    echo "<td><img src='" . $item_imgdir . "' width='60px' height='60px'></td>";
                                    echo "<td>" . $item_name . "</td>";
                                    echo "<td>₱" . $item_price . "</td>";
                                    echo "<td>" . $order_qty . "</td>";
                                echo "</tr>";
                            }
                                echo "<tr>";

                                    echo "<th colspan='3' style='text-align:right;'><span class='smtxt'>Total:</span><br><span class='dftxt'>₱</span></th>";
                                    echo "<th colspan='2'><button type='submit' class='btn btn-primary'>Checkout</button></th>";
                                echo "</tr>";
                            echo "</table";
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    <script type="text/javascript" src="js\bootstrap.min.js"></script>
    <script type="text/javascript" src="js\jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        //adds shadow to the bottom of navbar when scrolled
        window.addEventListener('scroll', function(){
            const shadow = document.querySelector('.navbar');
            if(window.pageYOffset>3){
                shadow.classList.add("add-shadow");
            }else{
                shadow.classList.remove("add-shadow");
            }
        });
        
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT i.item_id, i.item_imgdir, i.item_name, i.item_price, o.order_qty FROM orders o JOIN items i ON o.item_id = i.item_id WHERE o.user_id = $user_id";
        $result = query($conn, $sql);

        foreach($result as $key => $row) {
            $item_id = $row['item_id'];
            $item_imgdir = $row['item_imgdir'];
            $item_name = $row['item_name'];
            $item_price = $row['item_price'];
            $order_qty = $row['order_qty'];
            ?>
            if ($('.order').is(":checked")) {
                <?php $cost = "$('.order').val();";
                echo $cost;
                exit(); ?>
                document.getElementsByClassName("order").innerText = $cost;
            }
        <?php } ?>
    </script>
</html>