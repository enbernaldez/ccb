<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
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
                background-image: url("pics\\website_bg.png");
                background-size: cover;
                background-repeat: no-repeat;
            }
            .add-shadow {
                box-shadow: 0px 1px 10px black;
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
                <div class="col-3">
                    <h3>New Product</h3>

                    <?php
                         if(isset($_GET['new_product'])){
                                switch($_GET['new_product']){
                                    case "added": echo "<div class='alert alert-success'>Product Added.</div>";
                                          break;
                                    case "failed": echo "<div class='alert alert-danger'>Product Not Added</div>";
                                          break;

                                }
                           }
                    ?>

                    <form action="new_product.php" enctype="multipart/form-data" method="post">
                        <div class="my-3">
                            <label for="new_item_name" class="form-label">Product</label>
                            <input type="text" id="new_item_name" required name="new_item_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="new_item_cat" class="form-label">Category</label>
                            <select id="new_item_cat" required name="new_item_cat" class="form-select">
                                <option disabled selected>--select--</option>
                                <?php
                                $category = query($conn, "SELECT `category_id`, `category_name` FROM `category`");
                                foreach ($category as $key => $row) { ?>
                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="new_item_price" class="form-label">Price</label>
                            <input type="text" required id="new_item_price" name="new_item_price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="new_item_image" class="form-label">Image</label>
                            <input type="file" required id="new_item_image" name="new_item_image" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary mt-3">
                    </form>

                </div>
                <div class="col-9">
                   <h3>Product Records</h3>
                    <?php
                      $productlist = query($conn, "SELECT `item_id`, `item_name`, `item_price`, `item_imgdir` FROM `items` WHERE item_status='A'");
                     // var_dump($productlist);
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
                      foreach($productlist as $key => $row){
                          echo "<tr>";
                             echo "<td width=20%><img src='" . $row['item_imgdir'] . "' style='max-width:100%' /></td>";
                             echo "<td width=30%>" . $row['item_name'] . "</td>";
                             echo "<td width=20%>" . $row['item_price'] . "</td>";
                             echo "<td width=15%> <a class='btn btn-success' href='product_submit.php?item_name=" . $row['item_name'] . "&item_price=" .$row['item_price'] . "&item_id=". $row['item_id'] ."' > Update </a> </td>";
                             echo "<td width=15%> <a class='btn btn-danger' href='product_delete.php?item_id=". $row['item_id'] ." ' > Delete </a> </td>";
                        echo "</tr>";
                      }
                       echo "</table>";

                    ?>

                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </body>
    <script src="js/bootstrap.js"></script>
    <script>
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