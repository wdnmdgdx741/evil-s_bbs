<?php
session_start();
require './lib/init.php';
$username = $_SESSION['user'];
$sql = "select * from users where user_name='$username'";
$selecT = new MySql;
$data = $selecT->getRow($sql);

var_dump($data);