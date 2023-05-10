<?php
include_once "db_conn.php";

$loc = $_SESSION['location'];

if(isset($_POST['checklist'])) {
    date_default_timezone_set("Asia/Manila");
    $list = $_POST['checklist'];
    
    if(isset($_POST['delete'])) {
        foreach($list as $value) {

            $table = "orders";
            $fields = array( 'order_status' => 'X'
                           , 'last_update' => date("Y-m-d H:i:s")
                           );
            $filter = array( 'order_id' => $value );

            update($conn, $table, $fields, $filter);
        }

        if(update($conn, $table, $fields, $filter)) {
            header("location: " . $loc . "?cart_delete=success");
            exit();
        } else {
            header("location: " . $loc . "?cart_delete=failed");
            exit();
        }
    }
    if(isset($_POST['submit'])) {
        $_SESSION['list'] = $_POST['checklist'];
        header("location: orders.php");
        exit;
    }
} else {
    header("location: " . $loc);
    exit;
}

?>
