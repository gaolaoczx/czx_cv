import React, { Component }  from 'react';
import { Button, Form, FormGroup, Label, Input} from 'reactstrap';
import { observer, inject } from 'mobx-react';
import { Redirect } from 'react-router'

@inject("store")
@observer
class ResumeAdd extends Component {
  constructor(props) {
    super(props);
    this.state={'title':'','content':''};
  
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
    this.props.store.resume_add(this.state.title,this.state.content);
    event.preventDefault();
  }

  render()
  {
    return (
      <div>
        <h1>添加简历</h1>
        <Form onSubmit={this.handleSubmit}>
          <FormGroup>
            <Input type="test" name="title" className="form-control" placeholder="简历标题"  
            value={this.state.title} onChange={(e)=>{this.handleChange(e,'title');}}/>
          </FormGroup>
          <FormGroup>
            <Input type="textarea" name="content"  className="form-control"  
            placeholder="简历内容，支持markdown语法(不少于10个字符)"  style={{'minHeight':'200px'}}
            value={this.state.content} onChange={(e)=>{this.handleChange(e,'content');}} />
          </FormGroup>
          <Button color="primary" onClick={(e)=>this.handleSubmit(e)}  >保存简历</Button>
          { this.props.store.added && <Redirect to="/myresume"/>}
        </Form>
      </div>
    );
  }
}
export default ResumeAdd;
