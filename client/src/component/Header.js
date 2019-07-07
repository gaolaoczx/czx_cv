import React, { Component }  from 'react';
import { 
    Collapse, 
    Navbar,
    NavbarToggler, 
    NavbarBrand, 
    Nav, 
    NavItem, 
    NavLink,} from 'reactstrap';

class Header extends Component {
    constructor(props) 
    {
      super(props);
      this.toggleNavbar = this.toggleNavbar.bind(this);
      this.state = { collapsed: true };
    }
  
    toggleNavbar() {
      // console.log("clicked");
      this.setState({
        collapsed: !this.state.collapsed
      });
    }
    
    render()
    {
      return (
        <div>
            <Navbar style={{'backgroundColor':'#eee'}}  light >
                <NavbarBrand href="/"  className="mr-auto header-logo">
                    <img src="/czx.ico" height="45" className="d-inline-block align-top" alt="logo" />
                    <p className="d-inline-block align-middle logo_text" >简历网站</p> 
                </NavbarBrand>

                <NavbarToggler onClick={this.toggleNavbar} />
                <Collapse isOpen={!this.state.collapsed} navbar>
                <Nav className="ml-auto float-right" navbar>
                    <NavItem> <NavLink href="/myresume">我的简历</NavLink></NavItem>
                    <NavItem> <NavLink href="/logout">退出</NavLink></NavItem>
                    <NavItem> <NavLink href="/reg/">注册</NavLink></NavItem>
                    <NavItem> <NavLink href="/login">登录</NavLink></NavItem>
                </Nav>
                </Collapse>
            </Navbar>
        </div>
      );
    }
  }
  
  export default Header;