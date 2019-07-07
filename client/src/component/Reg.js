import React, { Component }  from 'react';
import { Button, Form, FormGroup, Label, Input} from 'reactstrap';
import { observer, inject } from 'mobx-react';
import {Redirect } from 'react-router'

@inject("store")
@observer
class Reg extends Component {
  constructor(props) {
    super(props);
    this.state = {'email': '','password':'','pw_confirm':''};

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleChange(event,field) {
    let data = {};
    data[field] = event.target.value;
    this.setState(data);
  }

  handleSubmit(event) {
    // console.log("submit");
    this.props.store.reg(this.state.email,this.state.password,this.state.pw_confirm);
    event.preventDefault();
  }

  render()
  {
    return (
      <div>
        <h1>用户注册</h1>
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
          <FormGroup>
            <Label for="examplePassword">Confirm Password</Label>
            <Input type="password" name="pw_confirm"  className="form-control"  placeholder="请再次输入密码(6~12个字符)" 
            value={this.state.pw_confirm} onChange={(e)=>{this.handleChange(e,'pw_confirm');}} />
          </FormGroup>
          <Button color="primary" onClick={this.handleSubmit} >注册</Button>
          { this.props.store.reg_ok && <Redirect to="/login"/>}
        </Form>
      </div>
    );
  }
}

export default Reg;
