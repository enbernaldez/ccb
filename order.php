<?php
include_once "db_conn.php";

if(isset($_POST['reference_number'])) {
    
    $o_order_id = $_POST['order_id'];
    $o_ref_num = $_POST['reference_number'];
    
    foreach ($o_order_id as $value) {
        
        $table = "orders";
        $fields = array( 'order_status' => 'P'
                       , 'order_ref_num' => $o_ref_num
                       );
        $filter = array( 'order_id' => $value );
        
        update($conn, $table, $fields, $filter);
    }
    
    if(update($conn, $table, $fields, $filter)) {
        header("location: products.php?confirm_order=success");
        exit();
    } else {
        header("location: products.php?confirm_order=failed");
        exit();
    }
}

?>