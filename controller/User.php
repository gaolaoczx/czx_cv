<?php
// 表示此类在当前命名空间下，若引用其他第三方库，需要加\
namespace GaoLao\Controller;

class User 
{
    function reg()
    {
        $data['title'] = "用户注册";   
        // send_json( $data );
        render_layout($data);
    }

    function save()
    {
        $email = trim( v("email"));
        $password = trim(v("password") );
        $pw_confirm = trim( v("pw_confirm") ); 
        
        if(strlen($email) < 1) e("邮箱不能为空");
        
        if( !filter_var($email , FILTER_VALIDATE_EMAIL))
        {
            e("email地址错误");
        }
        
        if(mb_strlen($password) < 6) e("密码不能短于6个字符");
        if(mb_strlen($password) > 12) e("密码不能长于12个字符");
        if(mb_strlen($pw_confirm) < 6) e("确认密码不能短于6个字符");
        if(mb_strlen($pw_confirm) > 12) e("确认密码不能长于12个字符");
        
        if($password != $pw_confirm) e("两次密码不一致");

        $sql = "INSERT INTO `user` ( `email`,`password`,`created_at` ) VALUES ( ? , ? , ? )";
        $data = [$email , password_hash($password , PASSWORD_DEFAULT) , date("Y-m-d H:i:s") ];
        run_sql( $sql , $data , 1062 , "Email地址已被注册");

        send_json(['msg'=>'注册成功']);
        // echo $info = "注册成功<script>location='./?m=user&a=login'</script>";
        // return $info;
    }

    function login()
    {
        $data['title'] = "用户登入";  
        render_layout($data);
    }

    function login_check()
    {
        $email = trim( v("email") );
        $password = trim( v("password") );
        
        if(strlen($email) < 1) e("邮箱不能为空");
        
        if( !filter_var($email , FILTER_VALIDATE_EMAIL))
        {
            e("email地址错误");
        }
        
        if(mb_strlen($password) < 6) e("密码不能短于6个字符");
        if(mb_strlen($password) > 12) e("密码不能长于12个字符");
    
        $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1 ";
        $user_list = get_data($sql , [ $email ]);
        $user = $user_list[0];

        if( !password_verify( $password, $user['password']) )
        {
            e("错误的email或密码");
        }
    
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['uid'] = $user['id'];

        $token = session_id();
        send_json(['token'=>$token,'msg'=>'登录成功']);
        // e("登录成功<script>location='./?m=resume&a=list'</script>");
        // return true;
    }

    function logout()
    {
        if( !headers_sent() )
            session_start();

        foreach($_SESSION as $key => $value)
        {
            unset($_SESSION[$key]);
        }
        
        // header("location:./");
        send_json(['msg'=>'done']);
    }
}