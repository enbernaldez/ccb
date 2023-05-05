<?php

function gen_order_ref_num($len) {
    $alpha_num = array('A','B','C','D','E','F','G','H','I','J','K','L','M',
                       'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                       '0','1','2','3','4','5','6','7','8','9','0');
    $key = "";
    for ($i = 0; $i <= $len; $i++){
        if($i%2 == 0 && $i > 0){
           $key .= $alpha_num[rand(0,25)];
        }
        else{
             $key .= $alpha_num[rand(26,sizeof($alpha_num)-1)];
        }
     }
    return $key;
}

function display_table($conn, $user, $status, $add_filter) {
//    if($status != 'C' || $status == 'C' && $add_filter != '') {
//        
//        echo "
//        <label for='reference_number'
//               class='form-label'
//               style='float: left;
//                      line-height: 40px;'>
//            Reference Number:
//        </label>
//        <span style='display: block;
//                     overflow: hidden;'>
//            <input name='reference_number'
//                   id='reference_number'
//                   type='text'
//                   value='" . gen_order_ref_num(16) . "'
//                   readonly='readonly'
//                   class='form-control'
//                   style='width= 95%;
//                          float: right;
//                          background-color: #FFEFC1;
//                          font-family: Consolas;
//                          font-size: 19px;
//                          padding-left: 14px;'>
//        </span>";
//    }
    
//    $sql = "SELECT o.order_id, 
//                   u.user_id, 
//                   i.item_id, 
//                   o.order_ref_num AS order_ref_num,
//                   i.item_name, 
//                   i.item_imgdir, 
//                   i.item_price, 
//                   o.order_qty, 
//                   (i.item_price * o.order_qty) AS subtotal
//            FROM orders o 
//            JOIN users u ON o.user_id = u.user_id
//            JOIN items i ON o.item_id = i.item_id
//            WHERE i.item_status != 'I' 
//              AND u.user_id = '$user' 
//              AND o.order_status = '$status'
//              $add_filter
//            ORDER BY o.order_id ASC";
//    $result = query($conn, $sql);
//    
//    $distinct_ref_num = '';
//    $alias = '';
//    if($status != 'C') {
//        $distinct_ref_num = "SELECT DISTINCT order_ref_num
//                             FROM (";
//        $alias = ") AS orders";
//    
//        $ref_num_sql = "$distinct_ref_num
//                        $sql
//                        $alias";
//        $ref_num_result = query($conn, $ref_num_sql);
//
//        if(!empty($ref_num_result)) {
//            foreach($ref_num_result as $key => $row) {
//                $ref_num = $row['order_ref_num'];
//
//                echo "
//                <label for='reference_number'
//                       class='form-label'
//                       style='float: left;
//                              line-height: 40px;'>
//                    Reference Number:
//                </label>
//                <span style='display: block;
//                             overflow: hidden;'>
//                    <input name='reference_number'
//                           id='reference_number'
//                           type='text'
//                           value='" . $ref_num . "'
//                           readonly='readonly'
//                           class='form-control'
//                           style='width= 95%;
//                                  float: right;
//                                  background-color: #FFEFC1;
//                                  font-family: Consolas;
//                                  font-size: 19px;
//                                  padding-left: 14px;'>
//                </span>";
//            }
//        }
//
//    }
    
    if(!empty($result)) {
        echo "
        <thead valign='middle'>";
        if($status == 'C' && $add_filter == '') {
            echo "<th></th>";
        }
        echo "
            <th colspan='2'>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </thead>";
            
        $total = 0;
        
        foreach($result as $key => $row) {
            $order_id = $row['order_id'];
            $item_imgdir = $row['item_imgdir'];
            $item_name = $row['item_name'];
            $item_price = $row['item_price'];
            $order_qty = $row['order_qty'];
            $subtotal = $row['subtotal'];
            
            echo "<tr valign='middle'>";
            if($status == 'C' && $add_filter == '') {
                echo "
                <td>
                    <input name='checklist[]'
                           type='checkbox'
                           value='" . $order_id . "'
                           class='table-data'>
                </td>";
            }
            echo "
                <input name='order_id[]'
                       id='" . $order_id . "'
                       type='text'
                       value='" . $order_id . "'
                       hidden
                       class='form-control'>
                <td>
                    <img src='" . $item_imgdir . "'
                         width='60px'
                         height='60px'>
                </td>
                <td class='table-data'>" . $item_name . "</td>
                <td class='table-data'>₱" . $item_price . "</td>
                <td class='table-data'>" . $order_qty . "</td>
                <td class='table-data'>
                    ₱" . number_format($subtotal, 2, '.', ',') . 
                "</td>
            </tr>";
            $total += $subtotal;
        }
        $total = number_format($total, 2, '.', ',');
        
        if($status == 'C') {
            if($add_filter == ''){
                $colspan = 6;
            } else {
                $colspan = 5;
            }
            echo "<tr valign='middle'>
                <td colspan='" . $colspan . "'
                    style='text-align: right;'>
                    <span class='smtxt me-3'>
                        Total:
                    </span>
                    <span class='dftxt'>
                        ₱" . $total .
                    "</span>
                </td>
            </tr>
            <tr valign='middle'>
                <td colspan='6'
                    style='text-align: right;'>
                    <button type='submit'
                            class='btn btn-primary table-data'>";
                    if($add_filter == '') {
                        echo "Checkout";
                    } else {
                        echo "Confirm Order";
                    }
                    echo "
                    </button>
                </td>
            </tr>";
        }
    } else {
        switch ($status) {
            case "C":
                echo "Cart is empty.";
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

function is_existing(mysqli $conn, 
                     string $value, 
                     string $column, 
                     string $table): bool
{
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
    
?>
