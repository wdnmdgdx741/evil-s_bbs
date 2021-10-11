<?php

require "./lib/init.php";
header("Content-type:text/html;charset=utf-8");
session_start();

if(!isset($_SESSION["user"]))
{
    echo "无权操作本界面";
    header("Refresh:2;url=login.php");
}else{

  
    $username = $_SESSION["user"];
    $sql = "select * from users where user_name='$username'";
    $userSQL = new MySql();
    $data = $userSQL->getRow($sql);

   require "./view/pub_comment.html";
}