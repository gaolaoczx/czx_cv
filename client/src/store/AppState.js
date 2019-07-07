import { observable , action } from 'mobx'
import $ from 'jquery';
import axios from 'axios';

var host='http://localhost:8088';

class AppState
{
    @observable reg_ok = false;
    @observable added = false;
    @observable modified = false;
    @observable deleted = false;
    @observable token = "";
    @observable curr_resume_id = "";
    @observable curr_resume_title = "";
    @observable curr_resume_content = "";
    @observable my_resume_list = [];
    @observable all_resume_list = [];
    
    constructor()
    {
        if( localStorage.getItem('token') ) this.token = localStorage.getItem('token');
    }

    @action 
    reg( email , password, pw_confirm) 
    {
        $.post( host+'/?m=user&a=save',{'email':email,'password':pw_confirm,'pw_confirm':password}, (data)=>
        {
            // console.log('data:'+data);
            if( data.code === 0 && data.data && data.data.msg && data.data.msg === '注册成功' )
                this.reg_ok = true;
        } , 'json');
    }

    @action 
    login( email , password) 
    {
        $.post( host+'/?m=user&a=login_check',{'email':email,'password':password}, (data)=>
        {
            if( data.code === 0 && data.data && data.data.token )
            {
                this.token = data.data.token;
                localStorage.setItem( 'token' , this.token );
            }
            // console.log('login token:'+this.token);
        } , 'json');
    }
    
    @action 
    logout( ) 
    {
        $.post( host+'/?m=user&a=logout',{ }, (data)=>
        {
            if( data.code === 0 && data.data && data.data.msg === 'done' )
            {
                this.token = '';
                this.reg_ok = false;
                this.deleted = false;
                this.added = false;
                this.modified = false;
                localStorage.setItem( 'token' , this.token );
            }
            // console.log('token:'+this.token);
        } , 'json');
    }

    @action 
    resume_add( title , content ) 
    {
        $.post( host+'/?m=resume&a=save',{'token':this.token,'title':title,'content':content}, (data)=>
        {
            console.log("data:"+data.code);
            if( data.code === 0 && data.data)
            {
                this.added = true ;
            }
            // console.log("my_list:"+this.my_resume_list);
        } , 'json');
    }

    @action 
    resume_modify( id , title , content ) 
    {
        $.post( host+'/?m=resume&a=save',{'token':this.token, 'id':id,'title':title,'content':content}, (data)=>
        {
            // console.log("data:"+data.code);
            if( data.code === 0 && data.data)
            {
                this.modified = true ;
            }
            // console.log("my_list:"+this.my_resume_list);
        } , 'json');
    }

    @action 
    get_curr_resume( rid ) 
    {
        $.post( host+'/?m=resume&a=detail&id='+rid, { }, (data)=>
        {
            // console.log("data-id:"+data.data.id);
            if( data.code === 0 && data.data )
            {
                this.curr_resume_id = data.data.id;
                this.curr_resume_title = data.data.title;
                this.curr_resume_content = data.data.content;
            }
            // console.log("resume_title:"+this.curr_resume_title);
        } , 'json');
    }

    @action 
    async get_resume( id )
    {
        var params = new URLSearchParams();
        params.append("id" , id);
        const { data } = await axios.post( host+'/?m=resume&a=detail' , params );

        if( parseInt( data.code , 10 ) === 0  )
        {
            this.current_resume_id = data.data.id;
            this.current_resume_title = data.data.title;
            this.current_resume_content = data.data.content;
        }
        return data ;
    }

    @action 
    get_my_resume( ) 
    {
        $.post( host+'/?m=resume&a=list',{'token':this.token}, (data)=>
        {
            // console.log("data:"+data.err.msg);
            if( data.code === 0 && data.data)
            {
                this.my_resume_list = data.data;
            }
            // console.log("my_list:"+this.my_resume_list);
        } , 'json');
    }

    @action 
    get_all_resume( ) 
    {
        $.post( host+'/?m=resume&a=index',{'token':this.token}, (data)=>
        {
            if( data.code === 0 && data.data)
            {
                this.all_resume_list = data.data;
            }
            // console.log("all_list:"+this.all_resume_list);
        } , 'json');
    }

    @action 
    delete( rid ) 
    {
        $.post( host+'/?m=resume&a=delete',{'token':this.token,'id':rid}, (data)=>
        {
            console.log(data.data.msg );
            if( data.code === 0 && data.data && data.data.msg && data.data.msg === 'done' )
                this.deleted = true;
        } , 'json');
    }

}

export default new AppState();