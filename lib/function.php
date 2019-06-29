<?php

// 判断当前是否为当前页面
function active_flag( $m , $a )
{
    if ( $m == g('m') && $a == g('a') )
    {
        return " active ";
    }
}

function is_login()
{
    if( !headers_sent() )
    {
        session_start(); 
    }
    
    return intval( $_SESSION['uid'] ) > 0 ;
}

function c($key)
{
    return isset( $GLOBALS['FWCONFIG'][$key] ) ? $GLOBALS['FWCONFIG'][$key] : false;
}

function g($key)
{              
    return isset( $GLOBALS[$key] ) ? $GLOBALS[$key] : false;
}

function v($key)
{
    return isset( $_REQUEST[$key] ) ? $_REQUEST[$key] : false;
}

function e( $msg )
{
    throw new Exception($msg);
}

function render()
{
    //$data , $template=null
    $args_num = func_num_args();
    if( $args_num < 1 ) return false;
    elseif( $args_num == 1 )
        $html = get_render_content( func_get_arg( 0 ) );
    elseif( $args_num == 2 )
        $html = get_render_content( func_get_arg( 0 ) , func_get_arg( 1 ) );
    elseif( $args_num == 3 )
        $html = get_layout_content( func_get_arg( 0 ) , func_get_arg( 1 ) , func_get_arg( 2 ) );

    if( $html ) echo $html;
}

// 根据不同的layout选择不同的布局模板来渲染页面，目前只有def
function render_layout( $data , $layout = 'def')
{
    if( $html = get_layout_content( $data , $layout ) )
        echo $html;
}

// content_blk表示在布局中填充的内容块
function get_layout_content( $data , $layout = null , $content_blk = null)
{
    if( $layout == null ) $layout = 'def';
    if( $content_blk == null ) $content_blk = g('m').'_'.g('a').'.tpl.php';

    $layout_file = VIEW.DS.$layout.'.layout.php';
    if( !file_exists( $layout_file ) )
    {
        e("布局模板不存在：".$layout_file);
        return false;
    }

    $data['__layout'] = $layout; //模板所在的目录
    $data['__cont_blk'] = $content_blk;
    return get_render_content( $data , $layout_file );
}

function get_render_content( $data , $template = null)
{
    if( $template == null ) 
        $template = VIEW_DEF.DS.g('m')."_".g('a').".tpl.php";

    if( !file_exists( $template ) )
    {
        e("模板不存在：".$template);
        return false;
    }
    
    ob_start();
    extract( $data );
    require $template;
    $out = ob_get_contents(); //三个ob函数搭配使用，将页面保存在变量中，而不是直接输出到界面
    ob_end_clean();

    return $out;
}

function pdo()
{
    if( !isset( $GLOBALS['CV_PDO'] ) )
    {
        $GLOBALS['CV_PDO'] = new PDO(c('MYSQL_DCN'),c('MYSQL_USER'),c('MYSQL_PASSWD'));
        if( $GLOBALS['CV_PDO'] ) $GLOBALS['CV_PDO']->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    return $GLOBALS['CV_PDO'];
}

function get_data($sql , $data = null , $error_number = null , $notice = null)
{
    return _db_run($sql , $data , $error_number , $notice);
}

function run_sql( $sql , $data = null , $error_number = null , $notice = null )
{
    return _db_run( $sql , $data , $error_number , $notice , false );
}

function _db_run( $sql , $data = null , $error_number = null , $notice = null , $return = true)
{
    try
    {
        $pdo = pdo();
        $sth = $pdo->prepare( $sql );
        $sth->execute( $data );
        if( $return ) return $sth->fetchAll(PDO::FETCH_ASSOC);
        else return true;
    }
    catch( PDOException $e )
    {
        if( $error_number )
        {
            $errorInfo = $sth->errorInfo();
            if( $errorInfo[1] == 1062 )
            {
                e( $notice );
            }
        }

        return false;
    }
}