<?php
session_start();
if(isset($_SESSION["username"])){
    header("Location: user.php");
}else{
    header("Location: ./view/register.html");
}