<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$is_login = intval( $_SESSION['uid'] ) < 1 ? false:true;

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `is_deleted` = 0 LIMIT 10";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $resume_list = $sth->fetchAll(PDO::FETCH_ASSOC);
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
    <title>简历网站</title>
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
        <?php include "./header.php" ?>
        <h1 class="title">最新简历</h1>
        <?php if( $resume_list ): ?>
            <ul class="resume_list">
                <?php foreach($resume_list as $resume): ?>
                    <li id="rlisr-<?=$resume['id'] ?>" class="list-group-item d-flex justify-content-between align-items-center resume-item">
                        <a href="./resume_detail.php?id=<?=$resume['id'] ?>" class="btn btn-light mr-auto" target="_blank" ><?= $resume['title'] ?></a>
                        <a href="./resume_detail.php?id=<?=$resume['id'] ?>" target="_blank"><img src="./img/open_in_new.png" alt="简历查看"></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="resume_add btn btn-light">
            <a href="resume_add.php"><img src="./img/add.png" alt="添加简历">添加我的简历</a>
        </div>
    </div>
</body>
</html>
