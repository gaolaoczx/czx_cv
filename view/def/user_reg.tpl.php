
<form action="./?m=user&amp;a=save" id="form_reg" onsubmit="send_form('form_reg');return false;">
    <div id="form_reg_notice" class="form_info full"></div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="请输入个人邮箱">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码(6~12个字符)">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" name="pw_confirm" class="form-control" id="exampleInputPassword1" placeholder="请重复密码)">
    </div>
    <button type="submit"  id='user_reg' class="btn btn-primary">注册</button>
</form>

