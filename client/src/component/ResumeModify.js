import React, { Component }  from 'react';
import { Button, Form, FormGroup, Label, Input} from 'reactstrap';
import { observer, inject } from 'mobx-react';
import { Redirect } from 'react-router'
import { withRouter } from "react-router";
// import ReactMarkdown from "react-markdown";

@withRouter
@inject("store")
@observer
class ResumeModify extends Component {
  constructor(props) {
    super(props);
    this.state={'id':0,'title':'','content':''};
  
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  // async componentWillMount()
  // {
  //   console.log('id:'+this.props.match.params.id);
  //   this.props.store.get_curr_resume(this.props.match.params.id);
  // }

  // componentDidMount()
  // {
  //   console.log('id:'+this.props.store.curr_resume_id);
  //   this.setState({"id":this.props.store.curr_resume_id,
  //       "title":this.props.store.curr_resume_title,
  //       "content":this.props.store.curr_resume_content});
  // }

  async componentDidMount()
  {
      const data = await this.props.store.get_resume( this.props.match.params.id );
      
      if( parseInt( data.code , 10 ) === 0  )
          this.setState( {"id":data.data.id,"title":data.data.title,"content":data.data.content} );
      else
          alert( data.error );          
  }

  handleChange(event,field) {
    let data = {};
    data[field] = event.target.value;
    this.setState(data);
  }

  handleSubmit(event) {
    // console.log("submit");
    if( this.state.title.length === 0 ||  this.state.content.length === 0 )
    {
        alert("简历名称和内容均为必填项");
        event.preventDefault();
        return false;
    }
  
    this.props.store.resume_modify(this.state.id,this.state.title,this.state.content);
  }

  render()
  {
    return (
      <div>
        <h1>修改简历</h1>
        <Form onSubmit={this.handleSubmit}>
          <FormGroup>
            <Input type="test" name="title" className="form-control" placeholder="简历标题"  
            value={this.state.title} onChange={(e)=>{this.handleChange(e,'title');}}/>
          </FormGroup>
          <FormGroup>
            <Input type="textarea" name="content"  className="form-control"  
            placeholder="简历内容，支持markdown语法(不少于10个字符)"  style={{'minHeight':'200px'}}
            value={this.state.content }  onChange={(e)=>{this.handleChange(e,'content');}} >
            </Input>
          </FormGroup>
          <Button color="primary" onClick={(e)=>this.handleSubmit(e)} >修改完成</Button>
          { this.props.store.modified && <Redirect to={'/resume/:'+this.state.id} />}
        </Form>
      </div>
    );
  }
}
export default ResumeModify;
