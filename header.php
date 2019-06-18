
<?php
function active_flag( $current_page )
{
    if ( $current_page == ltrim( $_SERVER['script_name'] , '/' ) )
    {
        return " active ";
    }
}
?>

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
        <?php if($is_login): ?>
            <li class="nav-item <?=active_flag( 'resume_list.php' )?>">
                <a class="nav-link" href="./resume_list.php">我的简历</a>
            </li>
            <li class="nav-item <?=active_flag( 'resume_list.php' )?>">
                <a class="nav-link" href="./user_logout.php">退出</a>
            </li>
        <?php else: ?> 
            <li class="nav-item <?=active_flag( 'resume_list.php' )?>">
                <a class="nav-link" href="./user_reg.php">注册</a>
            </li>
            <li class="nav-item <?=active_flag( 'resume_list.php' )?>">
                <a class="nav-link" href="./user_login.php">登录</a>
            </li>
        <?php endif; ?>
    </ul>
  </div>
</nav>
