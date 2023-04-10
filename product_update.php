<?php
include_once "db_conn.php";

//checks if value of name="update_item_id" is set and if file is uploaded successfully
if(isset($_POST['update_item_id'])) {
    
    //transfers value of name="" from form to variable
    $u_item_id  = $_POST['update_item_id'];
    $u_item_name = $_POST['update_item_name'];
    $u_item_cat = $_POST['update_item_cat'];
    $u_item_price = $_POST['update_item_price'];
        
    $file = $_FILES['update_item_imgdir']['name']; //basename.ext
    $fileext = pathinfo($file, PATHINFO_EXTENSION); //ext

    $temp = $_FILES['update_item_imgdir']['tmp_name'];
    $u_item_imgdir = "products/" . $u_item_name . "." . $fileext; ///target location
    
    //prepare arguments for update()
    $table = "items";
    $fields = array( 'item_name' => $u_item_name
                   , 'category_id' => $u_item_cat
                   , 'item_price' => $u_item_price 
                   , 'item_imgdir' => $u_item_imgdir 
                   );
    $filter = array( 'item_id' => $u_item_id );
    
    //if file is successfully moved to target loc:
    if(move_uploaded_file($temp, $u_item_imgdir)) {
        //updates arguments to db
        if(update($conn, $table, $fields, $filter )){
            header("location: product_index.php?update_item=success");
            exit();
        } else {
            header("location: product_index.php?update_item=failed");
            exit();
        }
   }
 }
?>