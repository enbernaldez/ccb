<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; 

    $user_id = $_SESSION['user_id'];
    $_SESSION['location'] = "delivery.php";
    $loc = $_SESSION['location'];
    
    ?>
    <head>
        <meta charset="UTF-8">
        <title>CCB Overview</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" href="ccb.css">
        <style>
            .sidenav {
                height: 100%;
                width: 260px;
                position: fixed;
                z-index: 88;
                top: 0;
                left: 0;
                background-color: #E5825F;
                overflow-x: hidden;
                padding: 95px 30px 25px 30px;
            }
            .sidenav a {
                text-decoration: none;
                margin: 10px 0;
                font-size: 18px;
                color: #311C09;
                display: block;
            }
            .sidenav a:hover {
                color: #FFEFC1;
            }
            .main {
                margin-left: 205px;
                padding: 52px 0;
            }
            hr {
                color: #311C09;
            }
        </style>
    </head>
    <body>
    <!--Navigation Bar-->
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <div class="sidenav">
                <a href="delivery.php?deliver">Orders To Deliver</a>
                <hr>
                <a href="delivery.php?delivered">Orders Delivered</a>
            </div>
            <div class="main">
                <?php
                if(isset($_GET['deliver'])) {
                ?>
                    <form action="order_action.php"
                          method="post">
                        <h4 class="header">Orders To Deliver</h4>
                        <input type="text"
                               name="subloc"
                               value="deliver"
                               hidden>
                            <?php
                            $list = '';
                            echo display_tables($conn, $user_id, 'S', $list, $loc);
                            ?>
                    </form>
                <?php
                }
                
                if(isset($_GET['delivered'])) {
                ?>
                    <h4 class="header">Orders Delivered</h4>
                    <input type="text"
                           name="subloc"
                           value="delivered"
                           hidden>
                        <?php
                        $list = '';
                        echo display_tables($conn, $user_id, 'D', $list, $loc);
                        ?>
                <?php
                }
                ?>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>