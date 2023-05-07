<?php

function gen_order_ref_num($len) {
    $alpha_num = array('A','B','C','D','E','F','G','H','I','J','K','L','M',
                       'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                       '0','1','2','3','4','5','6','7','8','9','0');
    $key = "";
    for ($i = 0; $i < $len; $i++){
        if($i%2 == 0 && $i > 0){
           $key .= $alpha_num[rand(0,25)];
        }
        else{
             $key .= $alpha_num[rand(26,sizeof($alpha_num)-1)];
        }
     }
    return $key;
}

function is_existing(mysqli $conn, string $value, string $column, string $table): bool {
    $value = mysqli_real_escape_string($conn, $value);
    $column = mysqli_real_escape_string($conn, $column);
    $table = mysqli_real_escape_string($conn, $table);

    $query = "SELECT COUNT(*) AS count 
              FROM $table
              WHERE $column = '$value'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return ($row['count'] > 0);
    }

    return false;
}

function display_tables($conn, $user, $status, $list, $loc) {
    $filter = '';
    if(!empty($list)) {
        $filter = "AND ";
        $count = 0;
        foreach($list as $value) {
            if($count == 0) {
                $filter .= "order_id = '$value'";
                $count++;
            } else {
                $filter .= " OR order_id = '$value'";
            }
        }
    }
    $sql = "SELECT o.order_id,
                   u.user_id,
                   i.item_id,
                   o.order_ref_num AS order_ref_num,
                   i.item_name,
                   i.item_imgdir,
                   i.item_price,
                   o.order_qty,
                   (i.item_price * o.order_qty) AS subtotal
            FROM orders o 
            JOIN users u ON o.user_id = u.user_id
            JOIN items i ON o.item_id = i.item_id
            WHERE i.item_status != 'I' 
              AND u.user_id = '$user' 
              AND o.order_status = '$status'
              $filter
            ORDER BY o.order_id ASC";
    $result = query($conn, $sql);
    
    if(!empty($result)) {
        $start = "SELECT DISTINCT order_ref_num
                  FROM (";
        $end = ") AS customer_orders";

        $ref_num_sql = "$start
                        $sql
                        $end";
        $ref_num_result = query($conn, $ref_num_sql);

        foreach($ref_num_result as $key => $row) {
            $ref_num = $row['order_ref_num'];
            //if confirmation
            if($list != '') {
                do {
                    $new_ref_num = gen_order_ref_num(16);
                } while($new_ref_num == $ref_num);
                $ref_num = $new_ref_num;
            }
            
            echo "
                <div class='row'>";
                //if not cart
                if($status != 'C' || $list != '') {
                    echo "
                    <div class='input-group mt-3 mb-1'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' 
                                  id='ref_num'
                                  style='line-height: 30px;
                                         background-color: #311C09;
                                         color: #FFEFC1;
                                         border-radius: 5px 0 0 5px;
                                         border-color: #311C09;''>
                                Reference Number:
                            </span>
                        </div>
                        <input name='reference_number'
                               id='reference_number'
                               type='text'
                               value='" . $ref_num . "'
                               readonly='readonly'
                               class='form-control'
                               style='float: right;
                                      background-color: #FFEFC1;
                                      font-family: Consolas;
                                      font-size: 19px;
                                      padding-left: 14px;
                                      border-radius: 0 5px 5px 0;
                                      border-color: #311C09;'
                               aria-describedby='ref_num'>
                    </div>";
                }
                echo "
                    <table class='table'>
                        <thead valign='middle'>";
            //if cart
            if($status == 'C' && $list == '') {
                echo "
                            <th></th>";
            }
            if($loc == "orders") {
                echo "
                            <th colspan='2'>";
            } else {
                echo "
                            <th>";
            }
            echo "
                                Product
                            </th> 
                            <th>Price</th> 
                            <th>Qty</th> 
                            <th>Subtotal</th>
                        </thead>";
            
            if($status != 'C') {
                $start = "SELECT DISTINCT order_id,
                                          item_name,
                                          item_imgdir,
                                          item_price,
                                          order_qty,
                                          subtotal
                          FROM (";
                $end = ") AS customer_orders
                        WHERE order_ref_num = '$ref_num'";
                
                $ref_num_orders_sql = "$start
                                       $sql
                                       $end";
                $result = query($conn, $ref_num_orders_sql);
            }
            $total = 0;
            
            foreach($result as $key => $row) {
                $order_id = $row['order_id'];
                $item_imgdir = $row['item_imgdir'];
                $item_name = $row['item_name'];
                $item_price = $row['item_price'];
                $order_qty = $row['order_qty'];
                $subtotal = $row['subtotal'];

                echo "
                        <tr valign='middle'>
                            <input name='order_id[]'
                                   id='" . $order_id . "'
                                   type='text'
                                   value='" . $order_id . "'
                                   hidden
                                   class='form-control'>";
                if($status == 'C' && $list == '') {
                    echo "
                            <td>
                                <input name='checklist[]'
                                       type='checkbox'
                                       value='" . $order_id . "'
                                       class='table-data'>
                            </td>";
                }
                if($loc == "orders") {
                    echo "
                            <td>
                                <img src='" . $item_imgdir . "'
                                     width='60px'
                                     height='60px'>
                            </td>";
                } 
                echo "
                            <td class='table-data'>" . $item_name . "</td>
                            <td class='table-data'>
                                ₱" . $item_price . "
                            </td>
                            <td class='table-data'>" . $order_qty . "</td>
                            <td class='table-data'>
                                ₱" . number_format($subtotal, 2, '.', ',') . "
                            </td>
                        </tr>";
                $total += $subtotal;
            }
            $total = number_format($total, 2, '.', ',');
            //if not cart
            if($status != 'C' || $list != '') {
                echo "
                        <tr valign='middle'>";
                if($status != 'C') {
                    echo "
                            <td colspan='2'
                                style='text-align: left;'>
                                <input name='cancel'
                                       value='Cancel'
                                       type='submit'
                                       class='btn btn-danger'>
                                <input name='ref_num'
                                       value='" . $ref_num . "'
                                       type='text'
                                       class='btn btn-danger'
                                       hidden>
                            </td>";
                }
                echo "
                            <td colspan='6'
                                style='text-align: right;'>
                                <span class='smtxt me-3'>
                                    Total:
                                </span>
                                <span class='dftxt'>
                                    ₱" . $total . "
                                </span>
                            </td>
                        </tr>";
            }
            //if cart and confirmation
            if($status == 'C') {
                echo "
                        <tr valign='middle'>
                            <td colspan='6'
                                style='text-align: right;'>";
                //if confirmation
                if($status = 'C' && $list != '') {
                    $submit = "Cancel";
                } else {
                    $submit =  "Delete";
                }
                echo "
                                <input name='delete'
                                       value='" . $submit . "'
                                       type='submit'
                                       class='btn btn-danger'>";
                //if not confirmation
                if($list == '') {
                    $submit = "Checkout";
                } else {
                    $submit =  "Confirm Order";
                }
                echo "
                                <input name='submit'
                                       value='" . $submit . "'
                                       type='submit'
                                       class='btn btn-primary'>
                            </td>
                        </tr>";
            }    
            echo "
                    </table>
            </div>";
        }
    } else {
        switch ($status) {
            case "C":
                echo "No items were added to cart.";
                break;
            case "P":
                echo "No pending orders.";
                break;
            case "B":
                echo "No orders in progress.";
                break;
        }
    }
}
    
?>
