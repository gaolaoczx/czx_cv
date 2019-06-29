
<form action="./?m=user&amp;a=login_check" id="form_login" onsubmit="send_form('form_login');return false;">
    <div id="form_login_notice" class="form_info full"></div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="请输入个人邮箱">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码(6~12个字符)">
    </div>
    <!-- <button type="submit" id="login_btn" class="btn btn-primary">登录</button> -->
    <button type="submit" id='user_login' class="btn btn-primary">登录</button>
</form>
