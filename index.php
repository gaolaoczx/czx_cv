<?php
if( !defined('DS') )  define('DS' , DIRECTORY_SEPARATOR);
define('ROOT' , __DIR__ );
define('VENDOR' , ROOT.DS."vendor" );
define('VIEW' , ROOT.DS."view" );
define('VIEW_DEF' , VIEW.DS."def" );
define('GL_NAME',"GaoLao\\Controller\\");

error_reporting( E_ALL & ~E_NOTICE );

include VENDOR.DS.'autoload.php';

try 
{
    $GLOBALS['m'] = v('m')?v('m'):"resume";
    $class = ucfirst( strtolower( $m ) );//将字符串全变为小写，再修改为首字母大写
    $GLOBALS['a'] = $a = v('a')?v('a'):"index";
    
    // print($class."_".$a);
    $controller = GL_NAME.$class;
    $obj = new $controller();
    if( method_exists( $obj , $a ) )
    {
        call_user_func( [$obj , $a ]);
    }
    else
    {
        e("method $a not exists");
    }
} 
catch (Exception $e) 
{
    die($e->getMessage());
}
