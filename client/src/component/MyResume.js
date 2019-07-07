import React, { Component }  from 'react';
import { 
  ListGroup, 
  ListGroupItem,
  Button  } from 'reactstrap';
import { observer, inject } from 'mobx-react';

@inject("store")
@observer
class MyResume extends Component {
  constructor(props) {
    super(props);
    this.state={};
  }

  componentDidMount()
  {
    this.props.store.get_my_resume();
  }

  delete_confirm ( resume_id )
  {
      // alert(resume_id);
      if ( window.confirm("真的要删除简历吗？") )
      {
        this.props.store.delete(resume_id);
      }
  }
  
  render()
  {
    const resume_list = this.props.store.my_resume_list;
    return (
      <div>
          <h1>我的简历</h1>
          <ListGroup>
            { resume_list.length > 0 && resume_list.map( (item)=>{
            return <ListGroupItem className="d-flex justify-content-between align-items-center" key={item.id} >
              <Button className="mr-auto" color="light" href={'/resume/'+item.id} target="_blank" key={item.id} >{item.title}</Button>
              <a href={'/resume/'+item.id} target="_blank"><img src="/open_in_new.png" alt="简历查看"/></a>
              <a href={'/resume_modify/'+item.id} ><img src="/mode_edit.png" alt="简历修改"/></a>
              <a onClick={(e)=>{this.delete_confirm(item.id);}} ><img src="/close.png" alt="简历删除"/></a>
            </ListGroupItem>
            } ) }

            { resume_list.length === 0 && 
            <Button color="light" href="/resume_add" className="resume_add">
              <img src="/add.png" alt="添加简历" />暂时没有新简历，点击添加
            </Button> }
          </ListGroup>

            { resume_list.length > 0 && 
            <Button color="light" href="/resume_add" className="resume_add">
              <img src="/add.png" alt="添加简历" />添加新简历
            </Button> }

           { this.props.store.deleted && window.location.reload() }
      </div>
    );
  }
}

export default MyResume;
