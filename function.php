<?php

function gen_sales($conn, $duration) {
    $sql = "SELECT i.item_name,
                   COUNT(i.item_name) AS order_ct,
                   SUM(o.order_qty) AS total_qty,
                   SUM(o.order_qty * i.item_price) AS sales,
                   DATE(o.last_update) AS last_updated
            FROM orders o
            JOIN items i ON i.item_id = o.item_id
            WHERE o.order_status = 'D'
              AND DATE(o.last_update) $duration
            GROUP BY i.item_name
            ORDER BY COUNT(i.item_name) DESC";
    $result = query($conn, $sql);
    
?>
<table class='table'>
    <thead>
        <th>Product</th>
        <th>Order Frequency</th>
        <th>Overall Amount</th>
        <th>Sales</th>
        <th>Last Update</th>
    </thead>
<?php
    $total = 0;
    foreach($result as $key => $row) {
        $item_name = $row['item_name'];
        $order_ct = $row['order_ct'];
        $total_qty = $row['total_qty'];
        $sales = $row['sales'];
        $last_updated = $row['last_updated'];
        
        $sales_d = number_format($sales, 2, '.', ',');
?>
    <tr valign='middle'>
        <td class='table-data'><?php echo $item_name; ?></td>
        <td class='table-data'><?php echo $order_ct; ?></td>
        <td class='table-data'><?php echo $total_qty; ?></td>
        <td class='table-data'>₱<?php echo $sales_d; ?></td>
        <td class='table-data'><?php echo $last_updated; ?></td>
    </tr>
<?php
        $total += $sales;
    }
    $total = number_format($total, 2, '.', ',');
?>
    <tr valign='middle'>
        <td colspan='3'></td>
        <td><span class='smtxt'>Total:</span><br><span class='dftxt'>₱<?php echo $total; ?></span></td>
        <td></td>
    </tr>
<?php
?>
</table>
<?php
}

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
    $user_filter = "AND u.user_id = '$user'";
    if(isset($_SESSION['user_type'])) {
        $user_type = $_SESSION['user_type'];
    }
    if($user_type == 'A' || $user_type == 'D') {
        $user_filter = '';
    }
    $sql = "SELECT o.order_id,
                   u.user_id,
                   i.item_id,
                   o.order_ref_num AS order_ref_num,
                   i.item_name,
                   i.item_imgdir,
                   i.item_price,
                   o.order_qty,
                   (i.item_price * o.order_qty) AS subtotal,
                   o.last_update
            FROM orders o 
            JOIN users u ON o.user_id = u.user_id
            JOIN items i ON o.item_id = i.item_id
            WHERE i.item_status != 'I' 
              AND u.user_status != 'I'
              $user_filter 
              AND o.order_status = '$status'
              $filter";
    $result = query($conn, $sql);
    
    if(!empty($result)) {
        $start = "SELECT DISTINCT order_ref_num
                  FROM (";
        $end = ") AS customer_orders
                ORDER BY last_update";

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
                if($ref_num != '') {
                    echo "
                    <div class='input-group mt-3 mb-1'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' 
                                  id='ref_num'
                                  style='line-height: 30px;
                                         background-color: #311C09;
                                         color: #FFEFC1;
                                         border-radius: 5px 0 0 5px;
                                         border-color: #311C09;'>
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
            }
            if($status == 'C' || $ref_num != '') {
                echo "
                    <table class='table'>
                        <thead valign='middle'>";
            //if cart
                if($status == 'C' && $list == '') {
                    echo "
                            <th></th>";
                }
                if($loc != "products") {
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
            //if not cart and confirmation
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
                    //if cart
                    if($status == 'C' && $list == '') {
                        echo "
                            <td>
                                <input name='checklist[]'
                                       type='checkbox'
                                       value='" . $order_id . "'
                                       class='table-data'>
                            </td>";
                    }
                    if($loc != "products") {
                        echo "
                            <td>
                                <img src='" . $item_imgdir . "'
                                     width='60px'
                                     height='auto'>
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
                
                echo "
                        <tr valign='middle'>
                            <td colspan='4'
                                style='text-align: left;'>";
                
                $subloc = '';
                switch($user_type) {
                    case 'C':
                        switch ($status) {
                            case 'C':
                                if($filter == '') {
                                    $rbtn = 'Delete';
                                    $gbtn = 'Checkout';
                                } else {
                                    $rbtn = 'Cancel';
                                    $gbtn = 'Confirm';
                                }
                                break;
                            case 'P':
                                $rbtn = 'Cancel';
                                break;
                        }
                        break;
                    case 'A':
                        switch ($status) {
                            case 'P':
                                $rbtn = 'Reject';
                                $gbtn = 'Accept';
                                $subloc = 'pending';
                                break;
                            case 'B':
                                $gbtn = 'Ship';
                                $subloc = 'baking';
                        }
                        break;
                    case 'D':
                        if($status == 'S') {
                            $gbtn = 'Delivered';
                            $subloc = 'deliver';
                        }
                }
                if(isset($rbtn)) {
                    if($status == 'C' && $filter == '' && $rbtn == 'Delete') {
                        echo "
                                <input name='delete'
                                       value='" . $rbtn . "'
                                       type='submit'
                                       class='btn btn-danger'>";
                    } else if($status == 'C' && $filter != '' && $rbtn == 'Cancel') {
                        echo "
                                <input name='delete'
                                       value='" . $rbtn . "'
                                       type='submit'
                                       class='btn btn-danger'>";
                    } else {
                        echo "
                                <a class='btn btn-danger'
                                   href='order_action.php?order_ref_num=" . $ref_num . "&user_type=" . $user_type . "&order_status=" . $status . "&btn=" . $rbtn . "&subloc=" . $subloc . "'>
                                    " . $rbtn . "
                                </a>";
                    }
                }
                if(isset($gbtn)) {
                    if($status == 'C' && $filter == '' && $gbtn == 'Checkout') {
                        echo "
                                <input name='submit'
                                       value='" . $gbtn . "'
                                       type='submit'
                                       class='btn btn-success'>";
                    } else if($status == 'C' && $filter != '' && $gbtn == 'Confirm') {
                        echo "
                                <input name='submit'
                                       value='" . $gbtn . "'
                                       type='submit'
                                       class='btn btn-success'>";
                    } else {
                        echo "
                                    <a class='btn btn-success'
                                       href='order_action.php?order_ref_num=" . $ref_num . "&user_type=" . $user_type . "&order_status=" . $status . "&btn=" . $gbtn . "&subloc=" . $subloc . "'>
                                        " . $gbtn . "
                                    </a>
                                </td>";
                    }
                }
                if($status != 'C' || $filter != '') {
                    echo "
                                <td style='text-align: center;'>
                                    <span class='smtxt'>
                                        Total:
                                    </span>
                                    <br>
                                    <span class='dftxt'>
                                        ₱" . $total . "
                                    </span>
                                </td>";
                }
                echo "
                            </tr>
                    </table>";
            }
            echo "
            </div>";
        }
    } else {
        switch($user_type) {
            case 'C':
                switch ($status) {
                    case "C":
                        echo "No items were added to cart.";
                        break;
                    case "P":
                        echo "No orders requested.";
                        break;
                    case "B":
                        echo "No orders in progress.";
                        break;
                    case "S":
                        echo "No orders on the way.";
                        break;
                    case "D":
                        echo "No orders purchased yet.";
                        break;
                }
                break;
            case 'A':
                switch ($status) {
                    case "P":
                        echo "No orders requested.";
                        break;
                    case "B":
                        echo "No orders in progress.";
                        break;
                    case "S":
                        echo "No orders out for delivery.";
                        break;
                    case "D":
                        echo "No orders delivered.";
                        break;
                    case "X":
                        echo "No orders cancelled.";
                        break;
                }
                break;
            case 'D':
                switch ($status) {
                    case "S":
                        echo "No orders to deliver.";
                        break;
                    case "D":
                        echo "No orders delivered yet.";
                        break;
                }
                break;
        }
    }

}
?>
