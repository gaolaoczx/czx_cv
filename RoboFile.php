<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * 单元测试，检测user类的相关方法
     */
    function user_test()
    {
        $this->_exec('codecept run unit UserTest');
    }

    /**
     * 验收测试
     */
    function cest_test()
    {
        $this->_exec('codecept run acceptance autotestCest');
    }

    /**
     * 先开窗口启动selenium_server，为验收测试提供服务
     */
    function selenium_server()
    {
        $this->_exec('E:\java\bin\java -jar E:\java\selenium-server-standalone-3.141.59.jar');
    }
    
}