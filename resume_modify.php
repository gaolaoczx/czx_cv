<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start();
if( intval($_SESSION['uid']) < 1)
{
    header("location:user_login.php");
    die("请先<a href='user_login.php'>登录</a>再添加简历");
}

if( intval($_REQUEST['id']) < 1 ) die("错误的简历ID");

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `resume` WHERE `id` = ? AND `is_deleted` = 0 LIMIT 1";
    $sth = $pdo->prepare($sql);
    $sth->execute([ intval($_REQUEST['id']) ]);
    $resume = $sth->fetch(PDO::FETCH_ASSOC);
    
    if( $resume['uid'] != $_SESSION['uid'] ) die("只能修改自己的简历");
    // print_r($resume);
}
catch ( Exception $e )
{
    die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改简历</title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <?php $is_login = true; include "./header.php" ?>
        <h1>修改简历</h1>
        <form action="resume_update.php" id="form_resume_modify" onsubmit="send_form('form_resume_modify');return false;">
            <div id="form_resume_modify_notice" class="form_info full"></div>
            <p><input type="text" name="title" class="full" value="<?=$resume['title'] ?>"></p>
            <p><textarea name="content" class="full"><?=htmlspecialchars($resume['content']) ?></textarea></p>
            <input type="hidden" name="id" value="<?=$resume['id'] ?>" />
            <p><input type="submit" value="修改完成" class="middle-botton"></p>
        </form>
    </div>
</body>
</html>
