<?php
if(isset($_SESSION['user_id'])) {
    $home = "home_page.php";
} else {
    $home = "landing_page.php";
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
                <a href="products.php">Products</a>
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    
                    <a class='ms-5' 
                       href='orders.php'>
                        Orders
                    </a>
                    <a class='mx-5' 
                       href=''>
                        <?php echo $_SESSION['username']; ?>
                    </a>
                    <a href='logout.php'>Log Out</a>
                <?php
                }
                ?>
            </dl>
        </div>
    </nav>
