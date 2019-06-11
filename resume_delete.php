<?php
session_start();
if( intval($_SESSION['uid']) < 1)
{
    header("location:user_login.php");
    die("请先<a href='user_login.php'>登录</a>再添加简历");
}

// error_reporting(E_ALL & ~E_NOTICE);

$id = intval( $_REQUEST["id"] );
if(strlen($id) < 1) die("无效的简历ID");

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `resume` SET `is_deleted` = 1,`title`=CONCAT(`title`,?) WHERE `id` = ? AND `uid` = ? AND `is_deleted` = 0 LIMIT 1";
    $sth = $pdo->prepare($sql);
    $sth->execute([ '_DEL_'.time() , $id , intval($_SESSION['uid']) ]);

    die("done");
    // die("简历删除成功<script>location='resume_list.php'</script>");

}
catch ( Exception $e )
{
    die($e->getMessage());
}





?>

