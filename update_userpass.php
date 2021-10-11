<?php
require "./lib/init.php";
session_start();
if (empty($_SESSION['user_update'])) {
    header('location: forget_pass.php');
} else {
    if (empty($_POST)) {
        echo "密码信息为空";
        header("Refresh:3;url=forget_pass.php");
    } else {
        if (empty($_POST['password']) || empty($_POST['repass'])) {
            echo "请输入您的新密码";
        } else {
            $password = trim($_POST['password']);
            $repass = trim($_POST['repass']);
            $username=$_SESSION['user_update'];
            if ($password === $repass) {
                $repass = md5($repass);
                $sql = "update users set user_pass='$repass' where user_name='$username'";
                $update = new MySql;
                $update->Exec($sql);
                $rows = $update->affectRows();
                if ($rows == 1) {
                    echo "执行成功";
                    echo "<a href='login.php'>返回登陆</a>";
                } else {
                    echo "执行失败，请重试";
                    header('refresh:3;url=set_newpass.php');
                }
            } else {
                echo "您输入的两次密码不同，请重试";
                header('refresh:3;url=set_newpass.php');
            }
        }
    }
}
