<?php

error_reporting(E_ALL & ~E_NOTICE);

$email = trim( $_REQUEST["email"] );
$password = trim( $_REQUEST["password"] );

if(strlen($email) < 1) die("邮箱不能为空");

if( !filter_var($email , FILTER_VALIDATE_EMAIL))
{
    die("email地址错误");
}

if(mb_strlen($password) < 6) die("密码不能短于6个字符");
if(mb_strlen($password) > 12) die("密码不能长于12个字符");

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1 ";
    $sth = $pdo->prepare($sql);
    $sth->execute([ $email ]);
    $user = $sth->fetch(PDO::FETCH_ASSOC);

    if(!password_verify( $password, $user['password']))
    {
        die("错误的email或密码");
    }

    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['uid'] = $user['id'];
    die("登录成功<script>location='resume_list.php'</script>");
}
catch ( Exception $e )
{
    die($e->getMessage());
}



?>

