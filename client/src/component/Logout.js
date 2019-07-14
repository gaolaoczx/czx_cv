import React, { Component }  from 'react';
import { observer, inject } from 'mobx-react';
import {Redirect } from 'react-router'

@inject("store")
@observer
class Logout extends Component 
{
  constructor(props) 
  {
    super(props);
    this.state={"redir":false};
  }

  async componentDidMount()
  {
    const data = await this.props.store.logout();
    if(data.code === 0)
      this.setState({'redir':true});
    else
      alert(data.err);
  }

  render()
  {
    return <div>
      <h1>正在退出...</h1>
      {this.state.redir && <Redirect to="./index.html#/"/>}
      </div>;
  }
}

export default Logout;
