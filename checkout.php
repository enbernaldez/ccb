<?php
include_once "db_conn.php";

//for confirmation
if(isset($_POST['reference_number'])) {
    
    date_default_timezone_set("Asia/Manila");
    $o_order_id = $_POST['order_id'];
    $o_ref_num = $_POST['reference_number'];
    //confirm order
    if(isset($_POST['submit'])) {
        foreach($o_order_id as $value) {

            $table = "orders";
            $fields = array( 'order_status' => 'P'
                           , 'order_ref_num' => $o_ref_num
                           , 'last_update' => date("Y-m-d H:i:s")
                           );
            $filter = array( 'order_id' => $value );

            update($conn, $table, $fields, $filter);
        }

        if(update($conn, $table, $fields, $filter)) {
            header("location: orders.php?confirm_order=success");
            exit();
        } else {
            header("location: orders.php?confirm_order=failed");
            exit();
        }
    }
    //cancel
    if(isset($_POST['delete'])) {
        unset($_POST['submit']);
        header("location: orders.php");
        exit;
    }
}

?>
