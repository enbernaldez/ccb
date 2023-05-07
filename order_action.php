<?php
include_once "db_conn.php";

$loc = $_SESSION['location'];

if(isset($_POST['cancel'])) {
    date_default_timezone_set("Asia/Manila");

    $ref_num = $_POST['ref_num'];

    $sql = "SELECT order_id, order_status
            FROM orders	
            WHERE order_ref_num = '" . $ref_num . "'
              AND order_status = 'P'
            GROUP BY order_id";
    $result = query($conn, $sql);
    $update = 0;
    foreach($result as $key => $row) {

        $table = "orders";
        $fields = array( 'order_status' => 'X'
                       , 'last_update' => date("Y-m-d H:i:s")
                       );
        $filter = array( 'order_id' => $row['order_id'] );

        if(update($conn, $table, $fields, $filter)) {
            $update++;
        }
    }

    if($update != 0) {
        header("location: " . $loc . ".php?order_delete=success");
        exit();
    } else {
        header("location: " . $loc . ".php?order_delete=failed");
        exit();
    }
} else {
    header("location: " . $loc . ".php");
    exit;
}

?>