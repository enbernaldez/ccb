<html>
<?php
    include_once "db_conn.php";
?>
    <head>
        <meta charset="UTF-8">
        <title>Orders</title>
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
                margin-left: 205px;
                padding: 50px 10px;
            }
            hr {
                color: #311C09;
            }
        </style>
    </head>
    <body>
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <div class="sidenav">
                <h4 class="header mb-4">Sales</h4>
                <a href="reports.php?today">Day</a>
                <hr>
                <a href="reports.php?week">Week</a>
                <hr>
                <a href="reports.php?month">Month</a>
                <hr>
                <a href="reports.php?year">Year</a>
            </div>
            <div class="main">
                <?php
                if(isset($_GET['today'])) {
                ?>
                <h4 class="header">Sales Today</h4>
                <form action="reports.php?today"
                      method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Specific Date</span>
                        <input type="date"
                               name="date"
                               class="form-control"/>
                        <input type="submit"
                               name="filter_date"
                               value="Filter"
                               class="btn btn-secondary"/>
                    </div>
                </form>
                <?php
                    $date = "CURRENT_DATE";
                    if(isset($_POST['date'])) {
                        $date = "'" . $_POST['date'] . "'";
                    }
                    $duration = "= $date";
                    echo gen_sales($conn, $duration);
                }
                
                if(isset($_GET['week'])) {
                ?>
                <h4 class="header">Sales This Week</h4>
                <?php
                    $duration = "BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -7 DAY) AND CURRENT_DATE";
                    echo gen_sales($conn, $duration);
                }
                
                if(isset($_GET['month'])) {
                ?>
                <h4 class="header">Sales This Month</h4>
                <?php
                    $duration = "BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH) AND CURRENT_DATE";
                    echo gen_sales($conn, $duration);
                }
                
                if(isset($_GET['year'])) {
                ?>
                <h4 class="header">Sales This Year</h4>
                <?php
                    $duration = "BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -1 YEAR) AND CURRENT_DATE";
                    echo gen_sales($conn, $duration);
                }
                ?>
            </div>
        </div>
    </body>
</html>