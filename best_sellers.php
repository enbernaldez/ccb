<?php
    $sql = "SELECT * FROM best_sellers ORDER BY order_ct DESC;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
?>
        <div class="row pt-3"  style="background-color:rgba(229,160,95,0.90); border-radius:10px;">
        <h4 class="header">Best Sellers</h4>
            <?php
            for($i = 0; $i < 2; $i++) { ?>
            <div class="flex-products pt-3">
                <?php
                for($j = 0; $j < 3; $j++) {
                    $row = mysqli_fetch_assoc($result);
                    $item_name = $row['item_name'];
                    $item_imgdir = $row['item_imgdir'];
                    $order_ct = $row['order_ct'];
                ?>
                <div class="img-wrap">
                    <img src="<?php echo $item_imgdir ?>" alt="<?php echo $item_name ?>"/>
                    <p class="img-descr"><?php echo $item_name ?></p>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
<?php } ?>

<!--use class="col" instead of style="display:flex;"-->