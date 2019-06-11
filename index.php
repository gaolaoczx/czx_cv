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
    //print_r($resume_list);
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
    <title>简历网站</title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <?php include "./header.php" ?>
        <h1>最新简历</h1>
        <?php if( $resume_list ): ?>
            <ul class="resume_list">
                <?php foreach($resume_list as $resume): ?>
                <li id="rlisr-<?=$resume['id'] ?>" >
                    <a href="./resume_detail.php?id=<?=$resume['id'] ?>" target="_blank" class="title middle"><?= $resume['title'] ?></a>
                    <a href="./resume_detail.php?id=<?=$resume['id'] ?>" target="_blank"><img src="./img/open_in_new.png" alt="简历查看"></a>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="resume_add">
            <a href="resume_add.php"><img src="./img/add.png" alt="添加简历">添加我的简历</a>
        </div>
    </div>
</body>
</html>
