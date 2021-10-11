<?php
//用户登陆
require "./lib/init.php";
if(empty($_POST)){
    echo "登陆信息为空";
    header("Refresh:1;url=login.php");
}else{
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username=trim($_POST["username"]);
        $password=md5(trim($_POST["password"]));
        $sql="select * from users where user_name='$username' and user_pass='$password'";
        $select=new MySql();
        $res=$select -> getRow($sql);

        if($res!=''){
            session_start();
            $_SESSION["user"]=$res["user_name"];
            header("Location: user.php");
        }else{
            echo "用户名或者密码错误!";
            header("Refresh:1;url=login.php");
        }
    }else{
        echo "登录信息不完整";
        header("Refresh:1;url=login.php");
    }
}