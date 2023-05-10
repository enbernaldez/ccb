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
        
        <div class="container"
             style="padding-top: 100px;">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" 
                     style="background-color:#945328; 
                            border-radius:10px; 
                            color: white; 
                            text-align: center;">
                    <h2 class="mb-4">About Us</h2>
                    <p> Our bakeshop, in particular, is a place where passion, quality, and tradition come <br>together to create a delightful experience for our customers. We believe in using <br> only the finest and freshest ingredients to craft our baked goods, ensuring that <br>every bite is a celebration of flavor.</p>
                    <p>From flaky croissants to creamy cakes, we offer a diverse range of baked goods <br> that are sure to please even the most discerning palates. Our skilled bakers take <br> great pride in their work and put care and passion into each and every item that <br>we offer. Whether its a classic pastry or a unique, seasonal offering, every <br> baked good that leaves our kitchen is a reflection of our consistent to quality.</p>
                    <p>At our bakeshop, we believe in more than just serving delicious treats; we believe <br> in creating memories. Whether you are stopping by a quick bite on the go or <br> sitting down to enjoy a leisurely breakfast with friens and family, we strive to <br> sake every visit to our bakery a memorable one.</p>
                </div> 
                <div class="col-2"></div>
            </div>
        </div>
        
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>