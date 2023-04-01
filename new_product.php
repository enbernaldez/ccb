<?php
    include_once "db_conn.php";

    if(isset($_POST['new_item_name']) && $_FILES['new_item_image']['error'] == '0') {
        $u_itemname = $_POST['new_item_name']; //itemname
        $u_itemcat = $_POST['new_item_cat'];
        $u_itemprice = $_POST['new_item_price'];
        $file = $_FILES['new_item_image']['name']; //basename.ext
        $filename = pathinfo($file, PATHINFO_FILENAME); //basename
        $fileext = pathinfo($file, PATHINFO_EXTENSION); //ext
             
        $item_new_name="products/" . $u_itemname . "." . $fileext;
     
//        if($u_itemname == $filename){
//            $u_itemimgdir = "products/" . $file; //products/basename.ext
//        } else {
//            $filename = rename($file, $u_itemname . "." . $fileext); //rename(basename.ext, itemname.ext)
//            $u_itemimgdir = "products/" . $filename; //products/itemname.ext
//        }
        
        $table = "items";
        $fields = array ('item_name' => $u_itemname
                        ,'category_id' => $u_itemcat
                        ,'item_price' => $u_itemprice
                       // ,'item_imgdir' => $u_itemimgdir
                        ,'item_imgdir' => $item_new_name
                        );
        
        $sql = "SELECT `item_name`, `category_id`, `item_price`, `item_imgdir` FROM `items` WHERE `item_name` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $u_itemname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $temp = $_FILES['new_item_image']['tmp_name'];
       // $item_imgdir = "products/" . $_FILES['new_item_image']['name'];
        //$item_new_name="products/" . $u_itemname . $fileext;
        if(move_uploaded_file($temp, $item_new_name)) {
            if(mysqli_num_rows($result) > 0) {
                echo 1;
    //            header("location: product_index.php?new_product=failed");
                exit();
            } else {
                if(insert($conn, $table, $fields)) {
                    echo "ok";
                    
                    //header("location: product_index.php?new_product=success");
                    exit();
                } else {
                    echo 2;
//                    header("location: landing_page.php?new_product=failed");
                    
                    exit();
                }
            }
        }
        
      
        
        mysqli_free_result($result);        
    }
?>