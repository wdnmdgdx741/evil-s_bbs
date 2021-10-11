<?php
require "./lib/init.php";

session_start();


if(!isset($_SESSION["user"]))
{
    echo "无权操作本界面";
    header("Refresh:3;url=login.php");
}else{
    if(!empty($_POST))
    {
        if(isset($_POST["user_email"])||isset($_POST["user_password"])||isset($_FILES))
        {

            //以此判断,依次修改
            $user_email = isset($_POST["user_email"])?trim($_POST["user_email"]):'';
            //var_dump($user_email);
            if($user_email!='')
            {
                //修改邮箱
                $username = $_SESSION["user"];
                $email_sql = "update users set user_email='$user_email' where user_name='$username'";
                $emailSQL = new MySql();
                $emailSQL->Exec($email_sql);

                $rows = $emailSQL->affectRows();
                if($rows==1){
                    //header("Location: user.php");
                    echo "<script>alert('邮箱修改成功!');</script>";
                }else{
                    echo "邮箱修改失败,操作失败";
                    header("Refresh:2;url=user_edit.php");
                }
            }

            $pass1 = isset($_POST["user_password"])?trim($_POST["user_password"]):'';
            $pass2 = isset($_POST["user_password2"])?trim($_POST["user_password2"]):'';

            /*
            var_dump($pass1);
            var_dump($pass2);
            exit();
            */

            if(($pass1!='')&&($pass1==$pass2))
            {
                $username = $_SESSION["user"];
                $password = md5($pass1);
                $pass_sql ="update users set user_pass='$password' where user_name='$username'";
                $passSQL = new MySql();
                $passSQL->Exec($pass_sql);

                $rows = $passSQL->affectRows();
                if($rows==1){
                    //header("Location: user.php");
                    echo "<script>alert('密码修改成功!');</script>";
                }else{
                    echo "密码修改失败,操作失败";
                    header("Refresh:2;url=user_edit.php");
                }
            }


            //头像设置操作,移动文件

            if($_FILES["user_pic"]["name"]!='')
            {
                //上传文件
                $pic_path = upFile();

                $username = $_SESSION["user"];
                $user_pic = $pic_path;
                //var_dump($pic_path);
                $pic_sql ="update users set user_pic='$pic_path' where user_name='$username'";

                $picSQL = new MySql();
                $picSQL->Exec($pic_sql);

                $rows = $picSQL->affectRows();
                if($rows==1){
                    //header("Location: user.php");
                    echo "<script>alert('图片修改成功!');</script>";
                    header("Refresh:1;url=user_edit.php");
                }else{
                    echo "图片修改失败,操作失败";
                    header("Refresh:1;url=user_edit.php");
                }
            }

            header("Refresh:1;url=user_edit.php");

        }else{
            echo "操作参数不正确2";
            header("Refresh:1;url=user_edit.php");
            
        }
    }else{
        echo "操作参数不正确1";
        header("Refresh:1;url=user_edit.php");
        
    }

}
