<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Chew Chew Bakeshop</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" href="ccb.css">
    </head>
    <body>
    <!--Navigation Bar-->
        <?php include_once "navbar.php"; ?>
        
    <!--Carousel-->
        <div class="container pt-5">
            <div class="row pt-3">
                <!--<div class="col-1"></div>-->
                <div class="col-7 mx-4">
                    <div class="container my-5">
                        <div id="carousel" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <h1 class="mx-2 my-3 tagline">Delicious Homemade & Award-Winning Pastries</h1>
                                    <div class="row mx-1">
                                        <h3 style="text-align:right;"><a class="link" style="font-family:Century Gothic; font-weight:bold;" href="products.php">Order now!</a></h3>
                                        <!--Log In-->
                                        <div class="col-3 pt-5">
                                            <h4 class="header" id="login">Log In</h4>
                                        </div>
                                        <div class="col-6">
                                            <!--displays alert for failed logins-->
                                            <?php
                                            if(isset($_GET['login'])){
                                                switch($_GET['login']){
                                                    case "wrongpass": echo "<div class='alert alert-warning'>Wrong password.
                                                    <button type='button' class='close bi bi-x-lg' style='float:right;' data-dismiss='alert' aria-label='Close'></button></div>";
                                                        break;
                                                    case "notreg": echo "<div class='alert alert-warning'>Username not registered.
                                                    <button type='button' class='close bi bi-x-lg' style='float:right;' data-dismiss='alert' aria-label='Close'></button></div>";
                                                        break;
                                                    case "unidstat": echo "<div class='alert alert-warning'>Unable to identify privilege.
                                                    <button type='button' class='close bi bi-x-lg' style='float:right;' data-dismiss='alert' aria-label='Close'></button></div>";
                                                        break;
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="col-3"></div>
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
                                            <p>Don't have an account? Register <a class="link" data-bs-target="#carousel" data-bs-slide="next">here</a>.</p>
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
                                                            <i class="bi bi-arrow-left" style="font-size:26px;"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-10 pt-2">
                                                        <h4 class="header">Register</h4>
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
<!--
                                                <div class="mb-4">
                                                    <label for="reg_password" class="form-label">Password</label>
                                                    <div class="toggle_pwd">
                                                        <input type="checkbox" id="pwd_toggle" onclick="toggle_pwd()" class="mx-2">
                                                        <label for="pwd_toggle" class="form-label">Show Password</label>
                                                    </div>
                                                    <input type="password" id="reg_password" required name="reg_password" class="form-control">
                                                </div>
-->
                                                <div class="mb-4">
                                                    <label for="reg_password" class="form-label">Password</label>
                                                    <div class="input-group mb-4">
                                                        <input type="password" id="reg_password" required name="reg_password" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="bi bi-eye" onclick="toggle_pwd()"></i></span>
                                                        </div>
                                                    </div>
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
                    <?php include "best_sellers.php"; ?>
                </div>
            </div>
        </div>
<!--
        <div class="absolute">
            <img src="pics/mascot.png" alt="mascot"/>
        </div>
-->
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>
