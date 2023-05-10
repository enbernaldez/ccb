<?php
    $sql = "SELECT i.item_id, 
                   i.item_name, 
                   i.item_imgdir, 
                   COUNT(o.order_id) AS order_ct
            FROM orders o
            JOIN items i ON i.item_id = o.item_id
            WHERE o.order_status = 'D'
            GROUP BY i.item_id, 
                     i.item_name, 
                     i.item_imgdir
            ORDER BY order_ct DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
?>
        <div class="row pt-3"  
             style="background-color:<?php echo $_SESSION['seller_bg']; ?>; 
                    border-radius:10px;">
            <h4 class="header pb-3">Best Sellers</h4>
            <?php
            for($i = 0; $i < 2; $i++) { ?>
            <div class="flex-products">
                <?php
                for($j = 0; $j < 3; $j++) {
                    $row = mysqli_fetch_assoc($result);
                    $item_name = $row['item_name'];
                    $item_imgdir = $row['item_imgdir'];
                    $order_ct = $row['order_ct'];
                ?>
                <div class="img-wrap">
                    <img src="<?php echo $item_imgdir ?>" 
                         alt="<?php echo $item_name ?>"/>
                    <p class="img-descr">
                        <?php echo $item_name ?>
                    </p>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
<?php } ?>

<!--use class="col" instead of style="display:flex;"-->
