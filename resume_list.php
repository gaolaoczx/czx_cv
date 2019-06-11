<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历"); 
}

$is_login = true;

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `uid` = ? AND `is_deleted` = 0 ";
    $sth = $pdo->prepare($sql);
    $sth->execute([ intval($_SESSION['uid']) ]);
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
    <title>我的简历</title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <?php include "./header.php" ?>
        <h1>我的简历</h1>
        <?php if( $resume_list ): ?>
            <ul class="resume_list">
                <?php foreach($resume_list as $resume): ?>
                <li id="rlisr-<?=$resume['id'] ?>" >
                    <a href="./resume_detail.php?id=<?=$resume['id'] ?>" target="_blank" class="title middle"><?= $resume['title'] ?></a>
                    <a href="./resume_detail.php?id=<?=$resume['id'] ?>" target="_blank"><img src="./img/open_in_new.png" alt="简历查看"></a>
                    <a href="./resume_modify.php?id=<?=$resume['id'] ?>" ><img src="./img/mode_edit.png" alt="简历修改"></a>
                    <a href="javascript:delete_confirm('<?=$resume['id']?>');void(0);"><img src="./img/close.png" alt="简历删除"></a>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="resume_add">
            <a href="resume_add.php"><img src="./img/add.png" alt="添加简历">添加简历</a>
        </div>
    </div>
</body>
</html>
