import React, { Component }  from 'react';
import { observer, inject } from 'mobx-react';
import {Redirect } from 'react-router'

@inject("store")
@observer
class Logout extends Component {
  constructor(props) {
    super(props);
    this.state={};
  }

  componentDidMount()
  {
    this.props.store.logout();
  }

  render()
  {
    return <Redirect to="/index"/>;
  }
}

export default Logout;
