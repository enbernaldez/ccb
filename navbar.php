<?php
if(isset($_SESSION['user_id'])) {
    $type = $_SESSION['user_type'];
    
    switch ($type) {
        case "A":
            $home = "overview.php";
            $products = "product_index.php";
            $orders = "order_index.php?pending";
            break;
        case "D":
            $home = "dashboard.php";
            $orders = "delivery.php?deliver";
            break;
        case "C":
            $home = "home_page.php";
            $products = "products.php";
            $orders = "orders.php";
            break;
        default:
            $home = "landing_page.php";
            $products = "products.php";
    }
} else {
    $home = "landing_page.php";
    $products = "products.php";
}
?>
<!--Navigation Bar-->
    <nav class="navbar">
        <div class="container">
            <a class="active" 
               href="<?php echo $home; ?>">
                <img src="pics/CCB Logo.png" 
                     width="50px" 
                     height="50px"/>
                Chew Chew Bakeshop
            </a>
            <dl style="padding-top: 12px;">
                <?php
                if($_SESSION['user_type'] != 'D') {
                    echo "
                    <a href=" . $products . ">Products</a>";
                }
                if(isset($_SESSION['user_id'])) {
                    echo "
                        <a class='ms-5' 
                           href='" . $orders . "'>
                            Orders
                        </a>";
                    if($_SESSION['user_type'] == 'A') {
                        echo "
                            <a class='ms-5' 
                               href='user_index.php?customer'>
                                Users
                            </a>
                            <a class='ms-5' 
                               href='reports.php?today'>
                                Reports
                            </a>";
                    }
                    echo "
                        <a class='mx-5' 
                           href=''>
                            " . $_SESSION['username'] . "
                        </a>
                        <a href='logout.php'>Log Out</a>";
                }
                if($_SESSION['user_type'] != 'A') {
                    echo "
                    <a class='ms-5'
                       href=about_us.php>About Us</a>";
                }
                ?>
            </dl>
        </div>
    </nav>
