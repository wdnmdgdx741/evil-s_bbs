<?php
require './lib/init.php';
session_start();
if (empty($_SESSION['user'])) {
    echo '您无权操作';
    header('refresh:2;url=login.php');
} else {
    if (!empty($_GET)) {
        if (isset($_GET['id'])) {
            $id = trim($_GET['id']);
            $sql = "delete from comment where comment_id=$id";
            $delete = new MySql;
            $delete->Exec($sql);
            $row = $delete->affectRows();
            if ($row == 1) {
                echo "<script>alert('删除成功！')</script>";
                header('refresh:2;url=user.php');
            } else {
                echo "<script>alert('删除失败！')</script>";
                header('refresh:2;url=user.php');
            }
        }
    } else {
        echo '您的参数不正确';
        header('refresh:2;url=user.php');
    }
}
