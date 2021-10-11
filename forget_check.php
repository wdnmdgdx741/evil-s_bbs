<?php
require "./lib/init.php";
if (empty($_POST['username']) || empty($_POST['email'])) {
    echo "您所提供的资料不完整";
    header('refresh:1; forget_pass.php');
} else {
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $sql = "select * from users where user_name='$username' and user_email='$email'";
        $select = new MySql;
        $data = $select->getRow($sql);
        if ($data != "") {
            session_start();
            $_SESSION['user_update'] = $data["user_name"];
            header("location: set_newpass.php");
        } else {
            echo "验证信息错误";
            header("Refresh:1;url=forget_pass.php");
        }
    } else {
        echo "验证信息不完整";
        header("Refresh:1;url=forget_pass.php");
    }
}
