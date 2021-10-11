<?php
require './lib/init.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('location: login.php');
} else {

    //获取用户信息
    $username = $_SESSION['user'];
    $sql = "select * from users where user_name='$username'";
    $selecT = new MySql;
    $data = $selecT->getRow($sql);

    //获取分页信息
    $sql_page = "select count(*) from comment where username='$username'";
    $curr_page = isset($_GET['page']) ? trim($_GET["page"]) : 1;
    $pageselect = new MySql();
    $pagecount = $pageselect->getOne($sql_page);
    //限制curr_page
    // if ($curr_page <= 0) {
    //     $curr_page=1;
    // }
    // if ($curr_page >= $pagecount) {
    //     $curr_page = $pagecount;
    // }
    $pagedata = getPage($pagecount, $curr_page);

    //获取分页用户的评论
    $start = ($curr_page - 1) * 5;
    $len = 5;
    $sql_comment = "select * from comment where username='$username' order by comment_id desc limit $start,$len";
    $commentsql = new MySql;
    $commentdata = $commentsql->getAll($sql_comment);
    include './view/user.html';
}

