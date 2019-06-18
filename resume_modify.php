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
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改简历</title>
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
        <h1 class="title">修改简历</h1>
        <form action="resume_update.php" id="form_resume_modify" onsubmit="send_form('form_resume_modify');return false;">
            <div id="form_resume_modify_notice" class="form_info full"></div>
            <div class="form-group">
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?=$resume['title'] ?>">
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="10"><?=htmlspecialchars($resume['content']) ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?=$resume['id'] ?>" />
            <button type="submit" class="btn btn-primary">修改完成</button>
        </form>
    </div>    
</body>
</html>
