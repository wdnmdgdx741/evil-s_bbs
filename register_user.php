<?php
require "./lib/init.php";
if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["repass"])){
    echo "注册信息不完整";
    header('Refresh:1;url=register.php');
}else{
    if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["repass"])){
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $repass=$_POST["repass"];
        if($password!=$repass){
            echo "密码不一致";
            header("refresh:2;url=register.php");
        }else{
            $repass=md5($repass);
            $userpic="./upload/default/pic.jpg";
            $sql="insert into users(user_name,user_email,user_pass,user_pic,join_date) values('$username','$email','$repass','$userpic',DATE_FORMAT(NOW(),'%Y-%m-%d'))";
            $insert=new MySql;
            $insert->Exec($sql);
            $rows=$insert->affectRows();
            if($rows==1){
                //注册成功
                session_start();
                $_SESSION["user"]=$user_name;
                header('location: user.php');
            }else{
                echo "用户名或者邮件重复，请重新注册";
                header("refresh:1;url:register.php");
            }
        }

    }else{
        echo "注册信息错误";
        header("refresh:1;url:register.php");
    }
}