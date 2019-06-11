<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户注册</title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <h1>用户注册</h1>
        <form action="user_save.php" id="form_reg" onsubmit="send_form('form_reg');return false;">
            <div id="form_reg_notice" class="form_info middle"></div>
            <p><input type="text" name="email" placeholder="请输入个人邮箱" class="middle"></p>
            <p><input type="password" name="password" placeholder="请输入密码(6~12个字符)" class="middle"></p>
            <p><input type="password" name="pw_confirm" placeholder="请重复密码" class="middle"></p>
            <p><input type="submit" value="注册" class="middle-botton"></p>
        </form>
    </div>
</body>
</html>
