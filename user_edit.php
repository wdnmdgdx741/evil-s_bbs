<?php
require './lib/init.php';
session_start();
if(empty($_SESSION['user'])){
    echo "您无权操作";
    header('location: login.php');
}else{
    $username=$_SESSION['user'];
    $sql="select * from users where user_name='$username'";
    $sqli=new MySql;
    $data=$sqli->getRow($sql);
    require './view/user_edit.html';
}