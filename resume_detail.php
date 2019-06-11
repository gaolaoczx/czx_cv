<?php
error_reporting(E_ALL & ~E_NOTICE);

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
    // print_r($resume);
}
catch ( Exception $e )
{
    die($e->getMessage());
}

include './lib/Parsedown.php';
$md = new Parsedown();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$resume['title'] ?></title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <h1><?=$resume['title'] ?></h1>
        <div class="content">
            <?=$md->text( $resume['content'] ) ?>
        </div>
    </div>
</body>
</html>
