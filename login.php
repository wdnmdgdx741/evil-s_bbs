<?php
//登陆界面
session_start();
if(isset($_SESSION["user"])){
    header('Location: user.php');
}else{
    require "./view/login.html";
}