<?php
include_once "db_conn.php";

//checks if value of name="reg_emailadd" is set
if(isset($_POST['reg_emailadd'])) {

    //transfers value of name="" from form to variable
    $r_username = $_POST['reg_username'];
    $r_fullname = $_POST['reg_fullname'];
    $r_address = $_POST['reg_address'];
    $r_contactno = $_POST['reg_contactno'];
    $r_emailadd = $_POST['reg_emailadd'];
    //hashes value of name="reg_password" from form then transfered to variable
    $r_pwdhash = password_hash($_POST['reg_password'], PASSWORD_ARGON2ID);

    $_SESSION["username"] = $r_username;
    $_SESSION["password"] = $_POST['reg_password'];
    
    //preparing arguments for insert()
    $table = "users";
    $fields = array('user_fullname' => $r_fullname
                   ,'user_address' => $r_address
                   ,'user_contactno' => $r_contactno
                   ,'user_emailadd' => $r_emailadd
                   ,'user_name' => $r_username
                   ,'user_pwdhash' => $r_pwdhash
                   );

    //retrieves info from db
    $filter = array($r_emailadd);
    $sql = "SELECT `user_fullname`, `user_address`, `user_contactno`, `user_emailadd`, `user_name`, `user_pwdhash` FROM `users` WHERE `user_emailadd` = ?";
    $result = query($conn, $sql, $filter);

    //if $result is empty, the param $r_emailadd does not exist in db
    if(!empty($result)) {
        header("location: landing_page.php?registration=existing");
        exit();
    }
    //inserts arguments to db
    else {
        if(insert($conn, $table, $fields)) {
            header("location: login.php?registration=success");
            exit();
        } else {
            header("location: landing_page.php?registration=failed");
            exit();
        }
    }
    mysqli_free_result($result);
}
?>
