import React, { Component }  from 'react';
import { 
  ListGroup, 
  ListGroupItem,
  Button  } from 'reactstrap';
import { observer, inject } from 'mobx-react';

@inject("store")
@observer
class MyResume extends Component 
{
  componentDidMount()
  {
    this.props.store.get_my_resume();
  }

  async delete_confirm ( resume_id )
  {
      // alert(resume_id);
      if ( window.confirm("真的要删除简历吗？") )
      {
        const data = await this.props.store.delete(resume_id);
        if(data.code === 0)
          window.location.reload()
        else
          alert(data.err);
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
              // 在匿名函数内再次返回每个item的内容
            return <ListGroupItem className="d-flex justify-content-between align-items-center" key={item.id} >
              <Button className="mr-auto" color="light" href={'./index.html#/resume/'+item.id} key={item.id} >{item.title}</Button>
              <a href={'./index.html#/resume/'+item.id}><img src="open_in_new.png" alt="简历查看"/></a>
              <a href={'./index.html#/resume_modify/'+item.id} ><img className="resume_modify" src="mode_edit.png" alt="简历修改"/></a>
              <a onClick={(e)=>{this.delete_confirm(item.id);}} ><img className="resume_delete" src="close.png" alt="简历删除"/></a>
            </ListGroupItem>
            } ) }

            { resume_list.length === 0 && 
            <Button color="light" href="./index.html#/resume_add" className="resume_add">
              <img src="add.png" alt="点击添加" />暂时没有新简历，点击添加
            </Button> }
          </ListGroup>

            { resume_list.length > 0 && 
            <Button color="light" href="./index.html#/resume_add" className="resume_add">
              <img src="add.png" alt="添加简历" />添加新简历
            </Button> }
      </div>
    );
  }
}

export default MyResume;
