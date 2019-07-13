import React, { Component }  from 'react';
import { Button, Form, FormGroup, Label, Input} from 'reactstrap';
import { observer, inject } from 'mobx-react';
import { Redirect } from 'react-router'

@inject("store")
@observer
class Login extends Component 
{
  constructor(props) 
  {
    super(props);
    this.state = {'email': '','password':'',"redir":false};

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  // 实时将页面的修改重新填充到页面显示中
  handleChange(event,field) {
    let data = {};
    data[field] = event.target.value;
    this.setState(data);
  }

  async handleSubmit(event) {
    const data = await this.props.store.login(this.state.email,this.state.password);
    console.log(data);
    
    if( data.code === 0 )
    {
      this.setState({'redir':true});
    }
    else
    {
      alert(data.err);
    }
  }

  render()
  {
    return (
      <div>
        <h1>用户登入</h1>
        <Form onSubmit={this.handleSubmit}>
          <FormGroup>
            <Label for="exampleEmail">Email</Label>
            <Input type="email" name="email" className="form-control" placeholder="请输入个人邮箱" 
            value={this.state.email} onChange={(e)=>{this.handleChange(e,'email');}}/>
          </FormGroup>
          <FormGroup>
            <Label for="examplePassword">Password</Label>
            <Input type="password" name="password"  className="form-control"  placeholder="请输入密码(6~12个字符)" 
            value={this.state.password} onChange={(e)=>{this.handleChange(e,'password');}} />
          </FormGroup>
          <Button color="primary" id="user_login" onClick={this.handleSubmit} >登录</Button>
          {/* 登录正常后跳转页面 */}
          { this.props.store.token && <Redirect to="/myresume"/>}
        </Form>
      </div>
    );
  }
}

export default Login;
