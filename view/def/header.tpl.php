
<nav class="header navbar navbar-expand-lg navbar-light" style="background-color: #eee;" >
  <a class="navbar-brand header-logo" href="./index.php">
    <img src="./img/czx.ico" height="45" class="d-inline-block align-top" alt="logo">
    <p class="d-inline-block align-middle logo_text">简历网站</p> 
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav float-right">
        <?php if( is_login() ): ?>
            <li class="nav-item <?=active_flag( 'resume','list' )?>">
                <a class="nav-link" id='my_resume' href="./?m=resume&a=list">我的简历</a>
            </li>
            <li class="nav-item <?=active_flag( 'user','logout' )?>">
                <a class="nav-link" id='logout' href="./?m=user&a=logout">退出</a>
            </li>
        <?php else: ?> 
            <li class="nav-item <?=active_flag( 'user','reg' )?>">
                <a class="nav-link" id='register' href="./?m=user&a=reg">注册</a>
            </li>
            <li class="nav-item <?=active_flag( 'user','login' )?>">
                <a class="nav-link" id='login' href="./?m=user&a=login">登录</a>
            </li>
        <?php endif; ?>
    </ul>
  </div>
</nav>
