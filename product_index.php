<html>
    <?php include_once "db_conn.php"; ?>
    <head>
        <meta charset="UTF-8">
        <title>Product Index</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-icons-1.9.1/bootstrap-icons.css">
        <link rel="stylesheet" href="ccb.css">
        <style>
            .new_prod {
                position: fixed; 
                left: 0; 
                padding: 50px 10px 50px 40px; 
                background-color: #E5825F; 
                height: 100%; 
                width: 350px;
            }
            .new_prod input {
                width: 100%;
            }
            .main {
                margin-left: 312px;
                padding: 50px 10px;
            }
        </style>
    </head>
    <body>
        <!--Navigation Bar-->
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <!--New Product Form-->
            <div class="new_prod">
                <h4 class="mb-3 header">New Product</h4>

                <!--displays alert when product is added successfully or not-->
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
                <form action="new_product.php" enctype="multipart/form-data" method="post" class="new-product">
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
        <div class="row">
                <!--Product Records-->
                <div class="col-9 main">
                    <h4 class="header">Product Records</h4>
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
                    ?>
                        <hr>

                        <table class='table table-bordered'>
                        <thead>
                             <th>Image</th>
                             <th>Product</th>
                             <th>Price</th>
                             <th>Action</th>
                        </thead>
                    <?php 
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
                            <!--Product Update Modal-->
                            <div class="modal fade" tabindex="-1" id="update<?php echo $item_id; ?>" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius:15px;">
                                        <div class="modal-header" style="background-color:#FF8E7B; border-radius:15px 15px 0 0;">
                                            <h4 class="modal-title">Update Product</h4>
                                            <button type="button" class="bi bi-x-lg" data-dismiss="modal"></button>
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
                        <?php } ?>
                        </table>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="ccb.js"></script>
</html>
