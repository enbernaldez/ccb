<?php
include_once "db_conn.php";

if(null !==($_POST['item_id'] && $_POST['cart_qty'])) {
    $a_user_id = $_SESSION['user_id'];
    $a_item_id = $_POST['item_id'];
    $a_cart_qty = $_POST['cart_qty'];
    
    $sql = "SELECT `order_id`, `user_id`, `item_id`, `order_qty`, `order_status` FROM `orders` WHERE `user_id` = ? && `item_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $a_user_id, $a_item_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) == 0) {
        $order_qty = 0;
        $order_qty += $a_cart_qty;

        $table = "orders";
        $fields = array('user_id' => $a_user_id
                       ,'item_id' => $a_item_id
                       ,'order_qty' => $order_qty
                       ,'order_status' => 'C'
                       );

        if(insert($conn, $table, $fields)) {
            header("location: products.php?add_to_cart=success");
            exit();
        } else {
            header("location: products.php?add_to_cart=failed");
            exit();
        }
    } else {
        $order_id = $row['order_id'];
        $order_qty = $row['order_qty'];
        $order_qty += $a_cart_qty;

        $table = "orders";
        $fields = array('order_qty' => $order_qty);
        $filter = array('order_id' => $order_id);

        if(update($conn, $table, $fields, $filter)) {
            header("location: products.php?add_to_cart=success");
            exit();
        } else {
            header("location: products.php?add_to_cart=failed");
            exit();
        }
    }
    mysqli_free_result($result);
}
?>