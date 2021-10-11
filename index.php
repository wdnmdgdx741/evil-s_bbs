<?php
require "./lib/init.php";
header("Content-type:text/html;charset=utf-8");
session_start();

//获取分页信息

    $sql_pageCount = "select count(*) from comment order by comment_id desc";
    $curr_page = isset($_GET["page"]) ? trim($_GET["page"]) : 1;
    $pageCountSQL = new MySql();
    $pageCount = $pageCountSQL->getOne($sql_pageCount);

    //限制$curr_page
    // if ($curr_page <= 0) {
    //     $curr_page = 1;
    // }

    // if ($curr_page >= $pageCount) {
    //     $curr_page = $pageCount;
    // }

    $pageData = getPage($pageCount, $curr_page);

    //var_dump($pageData);
    //require "./view/user.html";
    //exit();
    //获取分页用户的评论

    $start = ($curr_page - 1) * 5;
    $len = 5;
    $sql_comment = "select * from comment order by comment_id desc limit $start,$len";
    $commentSQL = new MySql();
    $commentData = $commentSQL->getAll($sql_comment);

    //var_dump($commentData);
    require "./view/message.html";