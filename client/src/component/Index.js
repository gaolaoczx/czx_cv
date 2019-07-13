import React, { Component }  from 'react';
import { ListGroup, ListGroupItem, Button  } from 'reactstrap';
import { observer, inject } from 'mobx-react';
import { Link } from 'react-router-dom';

@inject("store")
@observer
class Index extends Component 
{
  componentDidMount()
  {
    // store为private引入的appstate
    this.props.store.get_all_resume();
  }

  render()
  {
    const resume_list = this.props.store.all_resume_list;
    return (
      <div>
          <h1>最新简历</h1>
          <ListGroup>
            { resume_list.length > 0 && resume_list.map( (item)=>{
            return <ListGroupItem className="d-flex justify-content-between align-items-center" key={item.id} >
              <Button color="light" href={'/resume/'+item.id} target="_blank">{item.title}</Button>
              <Link to={'/resume/'+item.id} target="_blank"><img src="/open_in_new.png" alt="简历查看"/></Link>
            </ListGroupItem>
            } ) }

            { resume_list.length === 0 && 
            <Button color="light" href="/resume_add" className="resume_add">
              <img src="/add.png" alt="添加简历" />暂时没有新简历，点击添加
            </Button> }
            
          </ListGroup>
      </div>
    );
  }
}
export default Index;
