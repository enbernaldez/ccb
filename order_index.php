<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
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
                background-color: #FFEFC1;
            }
            .add-shadow {
                box-shadow: 0px 1px 10px black;
            }
            input, select {
                max-width: 90%;
            }
            .modal input, .modal select {
                max-width: 100%;
            }
            .icon {
                border: none;
                background: none;
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
        
        <div class="container pt-5">
            <div class="row mt-5">
                <div class="col-1"></div>
                <div class="col-10">
                    <!--display records of orders-->
                    <h3>Order Records</h3>
                    <?php
                        $productlist = query($conn, "SELECT i.item_id, i.item_name, i.item_price, i.item_imgdir, c.category_id, c.category_name FROM items i JOIN category c ON i.category_id = c.category_id WHERE i.item_status='A' ORDER BY i.item_id ASC");
                        echo "<hr>";
                            if(isset($_GET['update_status'])){
                                switch($_GET['update_status']){
                                    case "success": echo "<div class='alert alert-success'>Product list updated!</div>";
                                        break;
                                    case "failed":  echo "<div class='alert alert-danger'>Product list failed to be updated.</div>";
                                        break;
                                }
                            }
                        echo "<hr>";

                        echo "<table class='table table-bordered'>";
                        echo "<thead>";
                             echo "<th>Image</th>";
                             echo "<th>Product</th>";
                             echo "<th>Price</th>";
                             echo "<th>Action</th>";
                        echo "</thead>";
                        foreach($productlist as $key => $row) {
                            $item_id = $row['item_id'];
                            $item_name = $row['item_name'];
                            $category_id = $row['category_id'];
                            $item_price = $row['item_price'];
                            $item_imgdir = $row['item_imgdir'];
                            echo "<tr>";
                                echo "<td width=20%><img src='" . $item_imgdir . "' alt='" . $item_imgdir . "' style='max-width:100%' /></td>";
                                echo "<td width=20%>" . $item_name . "</td>";
                                echo "<td width=15%>" . $item_price . "</td>";
                                echo "<td width=15%> <a class='btn btn-success' data-toggle='modal' data-target='#update" . $item_id . "'> Update </a> </td>";
                                echo "<td width=15%> <a class='btn btn-danger' href='product_delete.php?item_id=". $item_id ."' > Delete </a> </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js\jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
    </script>
</html>