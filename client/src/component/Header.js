import React, { Component }  from 'react';
import { 
    Collapse, 
    Navbar,
    NavbarToggler, 
    NavbarBrand, 
    Nav, 
    NavItem, 
    NavLink,} from 'reactstrap';
import { observer , inject } from 'mobx-react';

@inject("store")
@observer
class Header extends Component 
{
    constructor(props) 
    {
      super(props);
      this.toggleNavbar = this.toggleNavbar.bind(this);
      this.state = { collapsed: true };
    }
  
    toggleNavbar() {
      // console.log("clicked");
      this.setState({collapsed: !this.state.collapsed});
    }
    
    render()
    {
      return (
        <div>
            <Navbar style={{'backgroundColor':'#eee'}}  light >
                {/* 可使用原bootstrap的类 */}
                <NavbarBrand href="./index.html#/"  className="mr-auto header-logo">
                    <img src="czx.ico" height="45" className="d-inline-block align-top" alt="logo" />
                    <p className="d-inline-block align-middle logo_text" >简历网站</p> 
                </NavbarBrand>

                <NavbarToggler className="navbar-toggler" onClick={this.toggleNavbar} />

                <Collapse isOpen={!this.state.collapsed} navbar>
                { this.props.store.token.length > 0 && <Nav className="ml-auto float-right" navbar>
                    <NavItem> <NavLink href="./index.html#/myresume">我的简历</NavLink></NavItem>
                    <NavItem> <NavLink href="./index.html#/logout">退出</NavLink></NavItem></Nav> }
                    
                { this.props.store.token.length === 0 && <Nav className="ml-auto float-right" navbar>
                    <NavItem> <NavLink href="./index.html#/reg">注册</NavLink></NavItem>
                    <NavItem> <NavLink href="./index.html#/login">登录</NavLink></NavItem></Nav>}
                </Collapse>
            </Navbar>
        </div>
      );
    }
  }
  
  export default Header;