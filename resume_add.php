<?php
session_start();
if( intval($_SESSION['uid']) < 1)
{
    header("location:user_login.php");
    die("请先<a href='user_login.php'>登录</a>再添加简历");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加简历</title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <?php $is_login = true; include "./header.php" ?>
        <h1>添加简历</h1>
        <form action="resume_save.php" id="form_resume_add" onsubmit="send_form('form_resume_add');return false;">
            <div id="form_resume_add_notice" class="form_info full"></div>
            <p><input type="text" name="title" placeholder="简历标题" class="full"></p>
            <p><textarea name="content" placeholder="简历内容，支持markdown语法(不少于10个字符)" class="full"></textarea></p>
            <p><input type="submit" value="保存简历" class="middle-botton"></p>
        </form>
    </div>
</body>
</html>
