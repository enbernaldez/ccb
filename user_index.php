<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Product Index</title>
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
                margin: 10px 5px;
                font-size: 18px;
                color: #311C09;
                display: block;
            }
            .sidenav a:hover {
                color: #FFEFC1;
            }
            .main {
                margin-left: 215px;
                padding: 50px 0;
                right: 0;
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
                <a href="user_index.php?customer">Customer</a>
                <hr>
                <a href="user_index.php?courier">Courier</a>
                <hr>
                <a href="user_index.php?admin">Admin</a>
            </div>
            <div class="main">
                <!--User Records-->
                <?php
                $filter ='';
                if(isset($_GET['customer'])) {
                    $user = "Customer";
                    $filter = "AND user_type = 'C'";
                }
                if(isset($_GET['courier'])) {
                    $user = "Courier";
                    $filter = "AND user_type = 'D'";
                }
                if(isset($_GET['admin'])) {
                    $user = "Admin";
                    $filter = "AND user_type = 'A'";
                }
                echo "
                    <h4 class='header'>" . $user . " Records</h4>";
                        $sql = "SELECT user_id, 
                                       user_name, 
                                       user_fullname,
                                       user_address, 
                                       user_contactno, 
                                       user_emailadd
                                FROM users 
                                WHERE user_status = 'A'
                                  $filter";
                        $userlist = query($conn, $sql);
                        echo "<hr>";
                            if(isset($_GET['update_status'])){
                                switch($_GET['update_status']){
                                    case "success": echo "<div class='alert alert-success'>Product list updated!</div>";
                                        break;
                                    case "failed":  echo "<div class='alert alert-danger'>Product list failed to be updated.</div>";
                                        break;
                                }
                            }
                    ?>
                    <hr>

                    <table class='table table-bordered'
                           style='border: solid #333;'>
                        <thead>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email Address</th>
                            <th>Action</th>
                        </thead>
                    <?php 
                        foreach($userlist as $key => $row) {
                            $user_id = $row['user_id'];
                            $user_name = $row['user_name'];
                            $user_fullname = $row['user_fullname'];
                            $user_address = $row['user_address'];
                            $user_contactno = $row['user_contactno'];
                            $user_emailadd = $row['user_emailadd'];
                            
                            if(null == $user_address) {
                                $user_address = "N/A";
                            }
                            if(null == $user_contactno) {
                                $user_contactno = "N/A";
                            } 
                            
                            echo "<tr>";
                                echo "<td>" . $user_fullname . "</td>";
                                echo "<td>" . $user_name . "</td>";
                                echo "<td>" . $user_address . "</td>";
                                echo "<td>" . $user_contactno . "</td>";
                                echo "<td>" . $user_emailadd . "</td>";
                                echo "<td> <a class='btn btn-danger' href='product_delete.php?item_id=". $user_id ."' > Delete </a> </td>";
                            echo "</tr>";
                        } ?>
                    </table>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>