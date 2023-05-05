<?php

include_once "db_conn.php";

$user_id = $_SESSION['user_id'];

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
            <div class="row">
                <div class="col">
                    <?php
                    if(isset($_POST['checklist'])) {
                        $list = $_POST['checklist'];
                    ?>
                        <form action="checkout.php" 
                              method="post">
                            <table class="table">
                                <h4 class="header">Confirm Order</h4>
                                <label for="reference_number" 
                                       class="form-label" 
                                       style="float: left;
                                              line-height: 40px;">
                                    Reference Number:
                                </label>
                                <span style="display: block; 
                                             overflow: hidden;">
                                    <input name="reference_number"
                                           id="reference_number"
                                           type="text"
                                           value="<?php echo gen_order_ref_num(16); ?>"
                                           readonly="readonly"
                                           class="form-control"
                                           style="width: 95%;
                                                  float: right;
                                                  background-color: #FFEFC1; 
                                                  font-family: Consolas; 
                                                  font-size: 19px;
                                                  padding-left: 14px">
                                </span>
                        <?php
                        $total = 0;
                        
                        foreach($list as $c) {
                            $add_filter = "AND order_id = $c";
                            echo display_table($conn, $user_id, 'C', $add_filter);
                        }
                        ?>
                            </table>
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="orders.php"
                              method="post">
                            <h4 class="header">Cart</h4>
                            <table class="table">
                            <?php   
                            $add_filter = '';
                            echo display_table($conn, $user_id, 'C', $add_filter); 
                            ?>
                            </table>
                        </form>
                    <?php
                    }
                    ?>
                </div>
<!--Pending Orders-->
                <div class="col">
                    <h4 class="header">Pending Orders</h4>
                    <table class="table">
                        <?php
                        $add_filter = '';
                        echo display_table($conn, $user_id, 'P', $add_filter);
                        ?>                    
                    </table>
                </div>
                <div class="col" style="background-color:#999">zxcvbnm</div>
            </div>
        </div>
    </body>
</html>