<?php
// 表示此类在当前命名空间下，若引用其他第三方库，需要加\
namespace GaoLao\Controller;

class Resume 
{
    function check_login()
    {
        if( !is_login() )
        {
            header("location:./?m=user&a=login");
            e("请先<a href='./?m=user&amp;a=login'>登录</a>再进行简历相关操作");
            exit;
        }
    }

    function index()
    {
        $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `is_deleted` = 0 LIMIT 10";
        $data['resume_list'] = get_data( $sql );
        $data['title'] = '最新简历';

        return render_layout( $data );
    }

    function list()
    {
        $this->check_login();

        $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `uid` = ? AND `is_deleted` = 0 ";
        $data['resume_list'] = get_data( $sql , [ intval($_SESSION['uid']) ]);
        $data['title'] = "我的简历";   
    
        return render_layout( $data );
    }

    function add()
    {
        $this->check_login();

        $data['title'] = "添加简历";   
        return render_layout( $data );
    }

    function save()
    {
        $this->check_login();

        $title = trim( v("title") );
        $content = strip_tags(trim( v("content") ));
        
        if(mb_strlen($title) < 1) e("标题不能为空");
        if(mb_strlen($content) < 10) e("简历内容不少于10个字符");

        $sql = "INSERT INTO `resume` ( `title`,`content`, `uid`, `created_at` ) VALUES ( ? , ? , ?,? )";
        $data = [$title , $content , intval($_SESSION['uid']) , date("Y-m-d H:i:s") ];
        run_sql( $sql , $data , 1062 , "简历标题已存在" );
    
        echo $info = "简历保存成功<script>location='/?m=resume&a=list'</script>";
        return $info;
    }

    function detail()
    {
        if( intval($_REQUEST['id']) < 1 ) e("错误的简历ID");

        $sql = "SELECT * FROM `resume` WHERE `id` = ? AND `is_deleted` = 0 LIMIT 1";
        $resume_list = get_data( $sql , [ intval($_REQUEST['id']) ] );
        $resume = $resume_list[0];
 
        //标题需过滤html标签
        $resume['title'] = strip_tags( $resume['title'] );
        $resume['content'] = ( new \Parsedown() )->text( $resume['content'] );

        $data['resume'] = $resume;
        $data['title'] = $resume['title'];   
    
        return render_layout( $data );
    }

    function modify()
    {
        $this->check_login();
        if( intval($_REQUEST['id']) < 1 ) e("错误的简历ID");    
        
        $sql = "SELECT * FROM `resume` WHERE `id` = ? AND `is_deleted` = 0 LIMIT 1";
        $resume_list = get_data( $sql , [ intval($_REQUEST['id']) ] );
        $resume = $resume_list[0];
        
        if( $resume['uid'] != $_SESSION['uid'] ) e("只能修改自己的简历");

        $data['resume'] = $resume;
        $data['title'] = "修改简历";   
        return render_layout( $data );
    }

    function update()
    {
        $this->check_login();

        $id = intval( v("id") );
        $title = trim( v("title") );
        $content = strip_tags(trim( v("content") ));
        
        if(strlen($id) < 1) e("无效的简历ID");
        if(mb_strlen($title) < 1) e("标题不能为空");
        if(mb_strlen($content) < 10) e("简历内容不少于10个字符");

        $sql = "UPDATE `resume` SET `title` = ? ,`content` = ? WHERE `id` = ? AND `uid` = ? AND `is_deleted` = 0 LIMIT 1";
        $data = [$title , $content , $id , intval($_SESSION['uid']) ];
        run_sql( $sql , $data );
    
        echo $info = "简历修改成功<script>location='/?m=resume&a=list'</script>";
        return $info;
    }

    function delete()
    {
        $this->check_login();
    
        $id = intval( $_REQUEST["id"] );
        if(strlen($id) < 1) die("无效的简历ID");   

        $sql = "UPDATE `resume` SET `is_deleted` = 1,`title`=CONCAT(`title`,?) WHERE `id` = ? AND `uid` = ? AND `is_deleted` = 0 LIMIT 1";
        run_sql( $sql , [ '_DEL_'.time() , $id , intval($_SESSION['uid']) ] );

        echo $info = "done";
        return $info;
    }
}