<?php 
if( !defined('DS') )  define('DS' , DIRECTORY_SEPARATOR);
define('ROOT' , __DIR__ .DS.'..'.DS. '..' );
define('VENDOR' , ROOT.DS."vendor" );
define('VIEW' , ROOT.DS."view" );
define('VIEW_DEF' , VIEW.DS."def" );

include VENDOR.DS.'autoload.php';

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
        //清理数据库
        $sql = "DELETE FROM `user` WHERE `email` LIKE '%@autotest.com' ";
        run_sql( $sql );
    }

    //通用函数测试 TODO
    public function testGlobals()
    {
        $GLOBALS['User'] = 'gaolao';
        $this->assertEquals( g('User') , 'gaolao' );
        $this->assertFalse( g('UserTest') );
    }

    //逻辑测试
    public function registerAssert( $email , $password , $pw_confirm , $ret )
    {
        $_REQUEST['email'] = $email;
        $_REQUEST['password'] = $password;
        $_REQUEST['pw_confirm'] = $pw_confirm;
        $user = new GaoLao\Controller\User();

        try
        {
            $user->save();
        }
        catch( Exception $e)
        {
            $this->assertEquals( $e->getMessage() , $ret );
        }
    }

    public function testRegister()
    {
        $email = 'test'. time() .'@autotest.com';

        $this->registerAssert( '' , '' , '' , "邮箱不能为空" );
        $this->registerAssert( '123456' , '' , '' , "email地址错误" );
        $this->registerAssert( $email , '123' , '' , "密码不能短于6个字符" );
        $this->registerAssert( $email , '1234567890123' , '' , "密码不能长于12个字符" );
        $this->registerAssert( $email , '123456' , '123' , "确认密码不能短于6个字符" );
        $this->registerAssert( $email , '123456' , '1234567890123' , "确认密码不能长于12个字符" );
        $this->registerAssert( $email , '123456' , '1234567' , "两次密码不一致" );
        $this->registerAssert( $email , '123456' , '123456' , "注册成功<script>location='./?m=user&a=login'</script>" );
        $this->registerAssert( $email , '123456' , '123456' , "Email地址已被注册" );
    }

    public function loginAssert( $email , $password , $ret )
    {
        $_REQUEST['email'] = $email;
        $_REQUEST['password'] = $password ;

        $user = new GaoLao\Controller\User();
        try
        {
            $user->login_check();
        }
        catch( Exception $e)
        {
            $this->assertEquals( $e->getMessage() , $ret );
        }
    }

    public function testLogin()
    {
        $this->loginAssert( '' , '' , "邮箱不能为空" );
        $this->loginAssert( '123456' , '' , "email地址错误" );
        $this->loginAssert( 'x@163.com' , '123' , "密码不能短于6个字符" );
        $this->loginAssert( 'x@163.com' , '1234567890123' , "密码不能长于12个字符" );
        $this->loginAssert( 'x@163.com' , '1234567' , "错误的email或密码" );
        $this->loginAssert( 'x@163.com' , '123456' , "登录成功<script>location='./?m=resume&a=list'</script>" );
    }

    //界面测试 TODO
}