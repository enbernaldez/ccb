<?php
include_once "db_conn.php";

if(isset($_GET['item_id'])){
      
    $table = "items";
    $d_item_id = $_GET['item_id'];
    $fields = array( 'item_status' => 'I' );
    $filter = array( 'item_id' => $d_item_id );
    
   if(update($conn, $table, $fields, $filter)) {
       header("location: product_index.php?delete_item=success");
       exit();
   } else {
        header("location: product_index.php?delete_item=failed");
        exit();
    }
}