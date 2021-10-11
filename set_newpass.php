<?php
session_start();
if(!isset($_SESSION['user_update'])){
    header('location: forget_pass.php');
}else{
    require "./view/set_newpass.html";
}