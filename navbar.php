<!--Navigation Bar-->
    <nav class="navbar">
        <div class="container">
            <a class="active" href="landing_page.php">
                <img src="pics/CCB Logo.png" width="50px" height="50px"/>
                Chew Chew Bakeshop
            </a>
            <li>
                <a href="products.php">Products</a>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo "<a class='ms-5' href='orders.php'>Orders</a>";
                    echo "<a class='mx-5' href=''>" . $_SESSION['username'] . "</a>";
                    echo "<a href='logout.php'>Log Out</a>";
                }
                ?>
            </li>
        </div>
    </nav>