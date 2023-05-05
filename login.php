<?php
include_once "db_conn.php";

if(isset($_POST['login_username']) || null !== ($_SESSION["username"] && $_SESSION["pwdhash"])){

    //checks if value of name="login_username" is set
    if(isset($_POST['login_username'])){

        //transfers value of name="" from form to variable
        $l_username = $_POST['login_username'];
        $l_password = $_POST['login_password'];

        //assigns value to session variables
        $_SESSION["username"] = $l_username;
        $_SESSION["password"] = $l_password;
    }
    else if(null !== ($_SESSION["username"] && $_SESSION["pwdhash"])) {

        //transfers value from session variable to variable
        $l_username = $_SESSION['username'];
        $l_password = $_SESSION['password'];
    }
    
    //retrieves info from db
    $sql = "SELECT `user_id`, `user_name`, `user_pwdhash`, `user_type` FROM `users` WHERE user_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $l_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    //transfers value from db to variable
    $_SESSION['user_id'] = $row['user_id'];
    $stored_password = $row['user_pwdhash'];
    $user_type = $row['user_type'];

    //if $result is empty, the param $l_username does not exist in db
    if(mysqli_num_rows($result) == 0) {
        header("location: landing_page.php?login=notreg");
        exit();
    }
    //verifies the pwd typed vs the pwd stored in db
    else {
        if(password_verify($l_password, $stored_password)) {
            switch ($user_type) {
                case "C":
                    header("location: home_page.php?user_name=" . $row['user_name']);
                    break;
                case "A":
                    header("location: overview.php?user_name=" . $row['user_name']);
                    break;
                case "D":
                    header("location: delivery_page.php?user_name=" . $row['user_name']);
                    break;
                default:
                    header("location: landing_page.php?login=unidstat");
            }
        } else {
            header("location: landing_page.php?login=wrongpass");
            exit();
        }
    }
    mysqli_free_result($result);
}

?>
