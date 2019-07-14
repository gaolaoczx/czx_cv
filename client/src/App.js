import React, { Component }  from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import { 
  HashRouter as Router, 
  Switch,
  Route, } from "react-router-dom";

import Header from './component/Header';
import Reg from './component/Reg';
import Login from './component/Login';
import Logout from './component/Logout';
import MyResume from './component/MyResume';
import Resume from './component/Resume';
import ResumeAdd from './component/ResumeAdd';
import ResumeModify from './component/ResumeModify';
import Index from './component/Index';

class App extends Component {
  render()
  {
    return (
      <Router>
      <div className="App">
        <div className="header">
          <Header/>
        </div>
        <div className="main">
          <Switch>
            <Route path="/reg" component={Reg}/>
            <Route path="/login" component={Login}/>
            <Route path="/logout" component={Logout}/>
            <Route path="/myresume" component={MyResume}/>
            <Route path="/resume/:id" component={Resume}/>
            <Route path="/resume_add" component={ResumeAdd}/>
            <Route path="/resume_modify/:id" component={ResumeModify}/>
            <Route path="/" component={Index}/>
          </Switch>
        </div>
      </div>
      </Router>
    );
  }
}

export default App;
