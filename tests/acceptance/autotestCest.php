<?php 
if( !defined('DS') )  define('DS' , DIRECTORY_SEPARATOR);
define('ROOT' , __DIR__ .DS.'..'.DS. '..' );
define('VENDOR' , ROOT.DS."vendor" );
define('VIEW' , ROOT.DS."view" );
define('VIEW_DEF' , VIEW.DS."def" );

include VENDOR.DS.'autoload.php';

class autotestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
        //清理数据库
        $sql = "DELETE FROM `user` WHERE `email` LIKE '%@autotest.com' ";
        run_sql( $sql );
        $sql = "DELETE FROM `resume` WHERE `title` LIKE '%@test' ";
        run_sql( $sql );
    }

    // 正常流程测试，异常流程待添加
    public function normalTest(AcceptanceTester $I)
    {
        // 测试数据
        $email = "test" . time() . "@autotest.com";
        $password = "123456";
        $title = "这是测试简历@test";
        $content = "这是测试简历，这是测试简历";
        $content_v2 = $content."_v2";

        // 首页
        $I->resizeWindow(1000, 1000);//限制界面大小，默认让下拉按键出来
        $I->amOnPage("/");
        $I->see("最新简历");

        // 注册用户
        $I->click(".navbar-toggler");
        $I->wait(1);
        $I->see("注册");
        $I->click('注册');
        $I->wait(1);
        $I->see("用户注册");
        $I->fillField("email", $email);
        $I->fillField("password",$password);
        $I->fillField("pw_confirm",$password);
        $I->wait(1);
        $I->click('#user_reg');
        $I->wait(1);
        $I->see("用户登入");

        // 用户登入
        $I->fillField('email',$email);
        $I->fillField('password',$password);
        $I->wait(1);
        $I->click('#user_login');
        $I->wait(1);
        $I->see('我的简历');

        // 添加简历
        $I->click('.resume_add');
        $I->wait(1);
        $I->see('添加简历');
        $I->fillField('title',$title);
        $I->fillField('content',$content);
        $I->wait(2);
        $I->click('.btn');
        $I->wait(1);
        $I->see('我的简历');
        $I->see($title);

        // 查看简历
        $I->click($title);
        $I->wait(2);
        $I->switchToNextTab();
        $I->see($title);
        $I->see($content); 
        $I->closeTab();
        $I->switchToPreviousTab();
        $I->see('我的简历');

        // 修改简历
        $I->click('简历修改');
        $I->wait(1);
        $I->see('修改简历');
        $I->fillField('title',$title);
        $I->fillField('content',$content_v2);
        $I->wait(2);
        $I->click('修改完成');
        $I->wait(1);
        $I->see('我的简历');
        $I->see($title);

        // 查看简历
        $I->click($title);
        $I->wait(1);
        $I->switchToNextTab();
        $I->see($title);
        $I->see($content_v2); 
        $I->closeTab();
        $I->switchToPreviousTab();
        $I->see('我的简历');
    
        // 删除简历
        $I->click('简历删除');
        $I->wait(1);
        $I->seeInPopup('真的要删除简历吗？');
        $I->acceptPopup();
        $I->wait(1);
        $I->dontSee($title);
        
        // 用户登出
        $I->click(".navbar-toggler");
        $I->wait(1);
        $I->see("退出");
        $I->click('退出');
        $I->wait(1);
        $I->see("最新简历");
        $I->click(".navbar-toggler");
        $I->wait(1);
        $I->see("登录");
    }
}
