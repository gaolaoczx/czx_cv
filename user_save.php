<?php

error_reporting(E_ALL & ~E_NOTICE);

$email = trim( $_REQUEST["email"] );
$password = trim( $_REQUEST["password"] );
$pw_confirm = trim( $_REQUEST["pw_confirm"] ); 

if(strlen($email) < 1) die("邮箱不能为空");

if( !filter_var($email , FILTER_VALIDATE_EMAIL))
{
    die("email地址错误");
}

if(mb_strlen($password) < 6) die("密码不能短于6个字符");
if(mb_strlen($password) > 12) die("密码不能长于12个字符");
if(mb_strlen($pw_confirm) < 6) die("确认密码不能短于6个字符");
if(mb_strlen($pw_confirm) > 12) die("确认密码不能长于12个字符");

if($password != $pw_confirm) die("两次密码不一致");

try
{
    $dcn = "mysql:host=localhost;dbname=czx_cv";
    $user = "root";
    $passw = "1208396032fcFC";

    $pdo = new PDO($dcn,$user,$passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `user` ( `email`,`password`,`created_at` ) VALUES ( ? , ? , ? )";
    $sth = $pdo->prepare($sql);
    $sth->execute([$email , password_hash($password , PASSWORD_DEFAULT) , date("Y-m-d H:i:s") ]);

    die("注册成功<script>location='user_login.php'</script>");

}
catch ( PDOException $e )
{
    $errorInfo = $sth->errorInfo();
    if( $errorInfo[1] == 1062)
    {
        die("email地址已被注册");
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

