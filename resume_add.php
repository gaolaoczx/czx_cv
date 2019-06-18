<?php
session_start();
if( intval($_SESSION['uid']) < 1)
{
    header("location:user_login.php");
    die("请先<a href='user_login.php'>登录</a>再添加简历");
}

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加简历</title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <?php $is_login = true; include "./header.php" ?>
        <h1 class="title">添加简历</h1>
        <form action="resume_save.php" id="form_resume_add" onsubmit="send_form('form_resume_add');return false;">
            <div id="form_resume_add_notice" class="form_info full"></div>
            <div class="form-group">
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="简历标题"  >
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" placeholder="简历内容，支持markdown语法(不少于10个字符)" id="exampleFormControlTextarea1" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">保存简历</button>
        </form>
    </div>
</body>
</html>
