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
                    <a href=""><?php echo $_SESSION['username'] ?></a>
                </li>
            </div>
        </nav>
        
        <div class="container pt-5">
            <div class="row mt-5">
                <div class="col-3" style="position:fixed;">
                    <h3 class="mb-3">New Product</h3>
                    
                    <!--display alert when product is added successfully or not-->
                    <?php
                    if(isset($_GET['new_product'])){
                        switch($_GET['new_product']){
                            case "success": echo "<div class='alert alert-success' style='max-width:90%;'>Product Added.</div>";
                                break;
                            case "failed": echo "<div class='alert alert-danger' style='max-width:90%;'>Product Not Added</div>";
                                break;
                        }
                    }
                    ?>
                    
                    <!--form for adding product-->
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
                                $categorylist = query($conn, "SELECT `category_id`, `category_name` FROM `category`");
                                foreach ($categorylist as $key => $row) {
                                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                } ?>
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
                <div class="col-3"></div>
                <div class="col-9">
                    <!--display records of product-->
                    <h3>Product Records</h3>
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
                            ?>
                            <!--modal for updating product-->
                            <div class="modal fade" tabindex="-1" id="update<?php echo $item_id; ?>" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius:15px;">
                                        <div class="modal-header" style="background-color:#FF8E7B; border-radius:15px 15px 0 0;">
                                            <h4 class="modal-title">Update Product</h4>
                                            <button type="button" class="icon bi-x-lg" data-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body px-4">
                                            <!--form for updating product-->
                                            <form action="product_update.php" enctype="multipart/form-data" method="post">
                                                <div class="mb-3">
                                                    <label for="update_item_name">Product</label>
                                                    <input type="text" hidden name="update_item_id" value="<?php echo $item_id; ?>" class="form-control">
                                                    <input type="text" name="update_item_name" id="update_item_name" value="<?php echo $item_name; ?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="update_item_cat">Category</label>
                                                    <select id="update_item_cat" name="update_item_cat" class="form-select">
                                                        <?php
                                                        $category = mysqli_query($conn, "SELECT category_name FROM category WHERE category_id = $category_id");
                                                        $row = mysqli_fetch_assoc($category);
                                                        echo "<option value='" . $category_id . "' selected>" . $row['category_name'] . "</option>";
                                                        $categorylist = query($conn, "SELECT * FROM `category`");
                                                        foreach ($categorylist as $key => $row) { 
                                                            $cat_id = $row['category_id'];
                                                            $cat_name = $row['category_name'];
                                                            if($category_id != $cat_id) {
                                                                echo "<option value='" . $cat_id . "'>" . $cat_name . "</option>";
                                                            }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Price</label>
                                                    <input type="text" name="update_item_price" id="update_item_price" value="<?php echo $item_price; ?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Image</label>
                                                    <input type="file" required name="update_item_imgdir" id="update_item_imgdir" class="form-control">
                                                </div>
                                                <div class="my-3">
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
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