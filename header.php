
<div class="header">
    <div class="logo">
        <a href="./index.php"><img src="./img/czx.ico" alt="logo"></a>
        <a href="./index.php"class="logo_text">简历网站</a>
    </div>
    <ul class="menu">
        <?php if($is_login): ?>
            <li><a href="./resume_list.php" >我的简历</a></li>
            <li><a href="./user_logout.php" >退出</a></li>
        <?php else: ?> 
            <li><a href="./user_reg.php" >注册</a></li>
            <li><a href="./user_login.php" >登录</a></li>
        <?php endif; ?>
    </ul>
</div>