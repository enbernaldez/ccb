<!DOCTYPE html>
<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>CCB Home</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" href="ccb.css">
        <style>
            html .home{
                height:100%;
                margin:0;
                background-image: url("pics\\home-bg.png");
                background-position:center, middle;
                background-repeat:no-repeat;
                background-size:cover;
            }
            .navbar {
                background: black;
            }
        </style>
    </head>
    <body class="home">
    <!--Navigation Bar-->
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <div class="row pt-3">
                <div class="col-8" style="padding-top:100px;">
                    <h5 style="color:white; font-family: Sigmar;">Whenever we bake, we bake with our heart.</h5>
				    <h1 style="font-size:72px; font-weight:bold; color:white;">Check our baked <br> products.</h1>
				    <button type="button" 
                            style="border: none;
                                   background-color: #df8690;
                                   border-radius:50px;
                                   padding: 15px 32px;
                                   display: inline-block;
                                   margin: 30px 0;
                                   margin-left:10%;
                                   cursor: pointer;">
                        <a href="products.php"
                           style="text-align: center;
                                  text-decoration: none;
                                  font-size: 16px;
                                  color: white;">
                            VIEW PRODUCTS
                        </a>
                    </button>
                </div>
                <div class="col-1"></div>
                <div class="col-3" style="padding-top:100px;">
                    <?php include_once "best_sellers.php"; ?>
                    
                </div>
                
            </div>
                <div class="row"
                     style="padding-top: 100px;">
                    <div class="col-4">
                         <h5 style="font-weight:600; color:white;">Follow Us</h5>  
                            <img src="pics/fb-icon.png"
                                 style="width:30px; height:auto;
                                        border-radius:7px;"> 
                            <img src="pics/ig-icon.jpg"
                                 style="width:30px; height:auto;
                                        border-radius:7px;
                                        margin:0 10px;"> 
                            <img src="pics/twitter-icon.png"
                                 style="width:30px; height:auto;
                                        border-radius:7px;">
                        
                    </div>
                    <div class="col-5"></div>
                    <div class="col-3" style="color:white;">
                         <h5>Contact Us</h5>
                            <h6>Email: ChewChew@gmail.com</h6>
                                <h6>Contact No. 09125190268</h6>
    
                        
                    </div>
                    <div class="row py-5">
                        <div class="col-6">
                            <h5> ©2023 Chew Chew Bakeshop. All Rights Reserved.</h5>
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
