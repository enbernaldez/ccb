<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Chew Chew Bakeshop</title>
        <link rel="stylesheet" href="css/bootstrap.css">
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
            body {
                background-image: url("pics\\landingp_bg.png");
                background-size: cover;
                background-repeat: no-repeat;
            }
            #carousel {
                border-radius: 25px;
                background-color: #E5A05F;
                padding: 20px;
                height: 500px;
            }
            h1 {
                font-family: Times New Roman;
                font-size: 56px;
                font-weight: bold;
                color: black;
            }
            .link a {
                color: #E83F37;
            }
            .link a:hover {
                color: #F0635C;
            }
            .flex-login {
                display: flex;
                justify-content: space-between;
            }
            .add-shadow {
                box-shadow: 0px 1px 10px black;
            }
            input[type=text], input[type=password], input[type=email] {
                background-color: #FFF7EE;
            }
            .icon {
                width: 25px;
                height: 15px;
            }
            .absolute {
                position: absolute;
                top: 450px;
                right: 205px;
            }
            .absolute img {
                width: 350px;
                height: 210px;
            }
            .flex-products {
                display: flex;
                justify-content: space-between;
                padding-right: 13px;
                padding-left: 13px;
            }
            .flex-products img {
                width: 75px;
                height: 75px;
            }
            .img-wrap {
                position: relative;
                height: 92px;
                width: 75px;
                font-size: 14px;
            }
            .img-descr {
                position: absolute;
                top: 0;
                bottom: 0;
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
            }
            .img-wrap:hover .img-descr {
                visibility: visible;
                opacity: 1;
            }
            .toggle_pwd {
                float: right;
                font-size: 12px;
            }
            .header1 {
                font-family: Bahnschrift SemiBold;
                color: black;
            }
            .header2 {
                font-family: Georgia;
                font-style: italic;
                font-weight: bold;
                color: black;
            }
        </style>
    </head>
    <body>
    <!--Navigation Bar-->
        <nav class="navbar">
            <div class="container">
                <a class="active" href="landing_page.php">
                    <img src="pics/CCB Logo.png" width="50px" height="50px"/>
                    Chew Chew Bakeshop
                </a>
                <li>
                    <a class="mx-5" href="products.php">Products</a>
                    <a href="about.php">About Us</a>
                </li>
            </div>
        </nav>
        
    <!--Carousel-->
        <div class="container pt-5">
            <div class="row pt-3">
                <div class="col-1"></div>
                <div class="col-7">
                    <div class="container my-5">
                        <div id="carousel" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <h1 class="mx-2 my-3">Delicious Homemade & Award-Winning Pastries</h1>
                                    <div class="row mx-1">
                                        <h3 class="link" style="text-align:right;"><a style="font-family:Century Gothic; font-weight:bold;" href="products.php">Order now!</a></h3>
                                        <!--Log In-->
                                        <h4 class="header1 pt-5">Log In</h4>
                                        <form action="login.php" method="post">
                                            <div class="flex-login my-2">
                                                <div>
                                                    <input type="text" required name="login_username" class="form-control" placeholder="Username">
                                                </div>
                                                <div>
                                                    <input type="password" required name="login_password" class="form-control" placeholder="Password">
                                                </div>
                                                <div>
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </div>
                                            <p class="link">Don't have an account? Register <a class="link" data-bs-target="#carousel" data-bs-slide="next">here</a>.</p>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <!-- Registration Form -->
                                    <div class="container">
                                        <div class="row">
                                            <form action="register.php" method="post">
                                                <div class="row mb-2">
                                                    <div class="col-1">
                                                        <a data-bs-target="#carousel" data-bs-slide="prev">
                                                            <img src="pics/arrow-left.png" class="icon my-3" alt="back"/>
                                                        </a>
                                                    </div>
                                                    <div class="col-10 pt-2">
                                                        <h4 class="header1">Register</h4>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reg_fullname" class="form-label">Full Name</label>
                                                    <input type="text" id="reg_fullname" required name="reg_fullname" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reg_emailadd" class="form-label">Email</label>
                                                    <input type="email" id="reg_emailadd" required name="reg_emailadd" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reg_username" class="form-label">Username</label>
                                                    <input type="text" id="reg_username" required name="reg_username" class="form-control">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="reg_password" class="form-label">Password</label>
                                                    <div class="toggle_pwd">
                                                        <input type="checkbox" id="pwd_toggle" onclick="toggle_pwd()" class="mx-2">
                                                        <label for="pwd_toggle" class="form-label">Show Password</label>
                                                    </div>
                                                    <input type="password" id="reg_password" required name="reg_password" class="form-control">
                                                </div>
                                                <div class="col my-3 reg-btn">
                                                    <input type="submit" class="btn btn-primary" style="float:center;">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-3 mt-5">
                    <!--Best Sellers-->
                    <div class="row pt-3"  style="background-color:rgba(229,160,95,0.90); border-radius:10px;">
                    <h4 class="header2">Best Sellers</h4>
                        <?php
                        $sql = "SELECT i.item_id, i.item_name, i.item_imgdir, COUNT(o.item_id) AS order_ct FROM `orders` o JOIN items i on o.item_id = i.item_id GROUP BY i.item_name ORDER BY COUNT(o.item_id) DESC";
                        $result = mysqli_query($conn, $sql);
                        for($i = 0; $i < 2; $i++) { ?>
                        <div class="flex-products pt-3">
                            <?php
                            for($j = 0; $j < 3; $j++) {
                                $row = mysqli_fetch_assoc($result);
                                $item_name = $row['item_name'];
                                $item_imgdir = $row['item_imgdir'];
                                $order_ct = $row['order_ct'];
                            ?>
                            <div class="img-wrap">
                                <img src="<?php echo $item_imgdir ?>" alt="<?php echo $item_name ?>"/>
                                <p class="img-descr"><?php echo $item_name ?></p>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute">
            <img src="pics/mascot.png" alt="mascot"/>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
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
        //allows user to see the password they typed
        function toggle_pwd() {
            var pwd = document.getElementById("reg_password");

            if (pwd.type === "password") {
                pwd.type = "text";
            } else {
                pwd.type = "password";
            }
        }
    </script>
</html>