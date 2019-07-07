<?php 

class apitestCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
        //清理数据库
        $sql = "DELETE FROM `user` WHERE `email` LIKE '%@autotest.com' ";
        run_sql( $sql );
        $sql = "DELETE FROM `resume` WHERE `title` LIKE '%这是测试简历@test%' ";
        run_sql( $sql );
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
        $email = "test".time()."@autotest.com";
        $password = "123456";
        $title = "这是测试简历@test";
        $content = "这是测试简历内容呢，没啥。";
        $content_v2 = $content."_v2";

        // 访问首页
        $I->sendPOST('/');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains('data');

        // 用户注册
        $I->sendPOST('/?m=user&a=save',['email'=>$email,'password'=>$password,'pw_confirm'=>$password]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains('注册成功');

        // 用户登录
        $I->sendPOST('/?m=user&a=login_check',['email'=>$email,'password'=>$password]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains('登录成功');

        $ret = json_decode( $I->grabResponse() ,true );
        $token = $ret['data']['token'];
        // $token = 'asdfj';
        // print_r("token:".$token);

        // 创建简历
        $I->sendPOST('/?m=resume&a=save',['token'=>"$token", 'title'=>$title, 'content'=>$content]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains('简历保存成功');

        $ret = json_decode( $I->grabResponse() , true  );
        $rid = $ret['data']['rid'];
        // print_r("rid:".$rid);

        // 查看简历
        $I->sendPOST('/?m=resume&a=detail',['id'=>$rid]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains($title);

        // 修改简历
        $I->sendPOST('/?m=resume&a=update',['token'=>"$token", 'id'=>$rid, 'title'=>$title, 'content'=>$content_v2]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains('简历修改成功');

        // 确认简历
        $I->sendPOST('/?m=resume&a=detail',['id'=>$rid]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains($content_v2);

        // 简历列表
        $I->sendPOST('/?m=resume&a=list',['token'=>"$token"]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains($title);

        // 删除简历
        $I->sendPOST('/?m=resume&a=delete',['token'=>"$token",'id'=>$rid]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->seeResponseContains('done');
        
        // 确认简历删除
        $I->sendPOST('/?m=resume&a=list',['token'=>"$token"]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->dontSeeResponseContains($title);

        // 用户退出
        $I->sendPOST('/?m=user&a=logout');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
        $I->seeResponseIsJson();
        $I->SeeResponseContains('done'); 
 
        // 确认登出
        foreach(['list','save','update','delete'] as $action) 
        {
            $I->sendPOST('/?m=resume&a='.$action , ['token'=>"$token"]);
            $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); 
            $I->seeResponseIsJson();
            $I->seeResponseContains("请先登录");
        }
    }
}
