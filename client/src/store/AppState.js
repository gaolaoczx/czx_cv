import { observable , action } from 'mobx'
import axios from 'axios';

var host='http://localhost:8088';

// 数据统一放在此处
class AppState
{
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

    async reg( email , password, pw_confirm) 
    {
        var params = new URLSearchParams();
        params.append("email" , email);
        params.append("password" , password);
        params.append("pw_confirm" , pw_confirm);
        const { data } = await axios.post( host+'/?m=user&a=save',params);
        return data;
    }

    @action 
    async login( email , password) 
    {
        var params = new URLSearchParams();
        params.append('email',email);
        params.append('password',password);
        const {data} = await axios.post( host+'/?m=user&a=login_check',params);

        if( data.code === 0  && data.data && data.data.token )
        {
            this.token = data.data.token;
            localStorage.setItem( 'token' , this.token );
        }

        console.log('login token:'+this.token);
        return data;
    }
    
    @action 
    async logout( ) 
    {
        var params = new URLSearchParams();
        const {data} = await axios.post( host+'/?m=user&a=logout',params);

        if( data.code === 0 && data.data && data.data.msg === 'done' )
        {
            this.token = '';
            localStorage.setItem( 'token' , this.token );
        }

        return data;
    }

    async resume_add( title , content ) 
    {
        var params = new URLSearchParams();
        params.append("token" , this.token);
        params.append('title',title);
        params.append('content',content);
        const {data} = await axios.post( host+'/?m=resume&a=save',params);
        
        return data;
    }

    async resume_modify( id , title , content ) 
    {
        var params = new URLSearchParams();
        params.append("token" , this.token);
        params.append('id',id);
        params.append('title',title);
        params.append('content',content);
        const {data} = await axios.post( host+'/?m=resume&a=update',params);

        return data;
    }

    @action 
    async get_curr_resume( id )
    {
        var params = new URLSearchParams();
        params.append("id" , id);
        const { data } = await axios.post( host+'/?m=resume&a=detail' , params );

        if( parseInt( data.code , 10 ) === 0  )
        {
            this.current_resume_id = data.data.id;
            this.current_resume_title = data.data.title;
            this.current_resume_content = data.data.content;
            console.log(this.current_resume_title);
        }

        return data ;
    }

    @action 
    async get_my_resume( ) 
    {
        var params = new URLSearchParams();
        params.append('token',this.token);
        const { data } = await axios.post( host+'/?m=resume&a=list',params);

        // console.log("data:"+data.err.msg);
        if( data.code === 0 && data.data)
        {
            this.my_resume_list = data.data;
            return this.my_resume_list;
        }

        return false;
    }

    @action 
    async get_all_resume( ) 
    {
        var params = new URLSearchParams();
        params.append('token',this.token);
        const { data } = await axios.post( host+'/?m=resume&a=index',params);

        // console.log("data:"+data.err.msg);
        if( data.code === 0 && data.data)
        {
            this.all_resume_list = data.data;
            return this.all_resume_list;
        }

        return false;
    }

    async delete( id ) 
    {
        var params = new URLSearchParams();
        params.append('token',this.token);
        params.append('id',id);
        const { data } = await axios.post( host+'/?m=resume&a=delete',params);

        return data;
    }

}

export default new AppState();