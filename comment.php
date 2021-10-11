<?php
require "./lib/init.php";
header("Content-type:text/html;charset=utf-8");
session_start();

if(!isset($_SESSION["user"]))
{
    echo "无权操作本界面";
    header("Refresh:3;url=login.php");
}else{
    if(!empty($_POST))
    {
        if(isset($_POST["username"]) && isset($_POST["comment_text"]))
        {
            //删除指定的评论
            $username = trim($_POST["username"]);
            $text = trim($_POST["comment_text"]);
            $sql = "insert into comment(username,text,pub_date) values('$username','$text ',now())";

            //insert into comment(username,text,pub_date) values('111','7777777777',now());
            $pubSQL = new MySql();
            $pubSQL->Exec($sql);

            $rows = $pubSQL->affectRows();
            if($rows==1){
                //header("Location: user.php");
                echo "<script>alert('评论成功!');</script>";
                header("Location: user.php");
            }else{
                echo "评论失败,操作失败";
                header("Refresh:2;url=pub_comment.php");
            }
        }else{
            echo "提交参数不正确";
            header("Refresh:3;url=pub_comment.php");
        }
    }else{
        echo "操作参数不正确";
        header("Refresh:3;url=pub_comment.php");
    }

}
