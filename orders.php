<?php

include_once "db_conn.php";

$user_id = $_SESSION['user_id'];
$_SESSION['location'] = "orders";
$loc = $_SESSION['location'];

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Orders</title>
        <link rel="stylesheet" 
              href="css/bootstrap.css">
        <link rel="stylesheet" 
              href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" 
              href="ccb.css">
    </head>
    <body>
        <?php include_once "navbar.php"; ?>
        <div class="container" 
             style="padding-top: 80px;">
            <div class="row pt-4">
                <div class="col">
                    <?php
                    if(isset($_SESSION['list'])) {
                    ?>
                        <form action="checkout.php" 
                              method="post">
                            <h4 class="header">Confirm Order</h4>
                            <?php
                            $list = $_SESSION['list'];
                            echo display_tables($conn, $user_id, 'C', $list, $loc);
                            ?>
                        </form>
                    <?php
                    unset($_SESSION['list']);
                    } else {
                    ?>
                        <form action="cart_action.php"
                              method="post">
                            <h4 class="header">Cart</h4>
                            <?php   
                            $list = '';
                            echo display_tables($conn, $user_id, 'C', $list, $loc); 
                            ?>
                        </form>
                    <?php
                    }
                    ?>
                </div>
<!--Pending Orders-->
                <div class="col">
                    <form action="order_action.php"
                          method="post">
                        <h4 class="header">Pending Orders</h4>
                            <?php
                            $list = '';
                            echo display_tables($conn, $user_id, 'P', $list, $loc);
                            ?>
                    </form>
                </div>
                <div class="col" style="background-color:#999">zxcvbnm</div>
            </div>
        </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
    </body>
</html>
