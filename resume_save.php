<?php
session_start();
if( intval($_SESSION['uid']) < 1)
{
    header("location:user_login.php");
    die("请先<a href='user_login.php'>登录</a>再添加简历");
}

error_reporting(E_ALL & ~E_NOTICE);

$title = trim( $_REQUEST["title"] );
$content = strip_tags(trim( $_REQUEST["content"] ));

if(mb_strlen($title) < 1) die("标题不能为空");
if(mb_strlen($content) < 10) die("简历内容不少于10个字符");

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `resume` ( `title`,`content`, `uid`, `created_at` ) VALUES ( ? , ? , ?,? )";
    $sth = $pdo->prepare($sql);
    $sth->execute([$title , $content , intval($_SESSION['uid']) , date("Y-m-d H:i:s") ]);

    die("简历保存成功<script>location='resume_list.php'</script>");

}
catch ( PDOException $e )
{
    $errorInfo = $sth->errorInfo();
    if( $errorInfo[1] == 1062)
    {
        die("简历标题已存在");
    }
    else
    {
        die($e->getMessage());
    }
}
catch ( Exception $e )
{
    die($e->getMessage());
}





?>

