<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>CCB Home</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" href="ccb.css">
    </head>
    <body>
    <!--Navigation Bar-->
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <div class="row pt-3">
                <div class="col-1"></div>
                <div class="col-7">
                    
                </div>
                <div class="col-1"></div>
                <div class="col-3 mt-5">
                    <?php include_once "best_sellers.php"; ?>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>