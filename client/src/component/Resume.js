import React, { Component }  from 'react';
import { observer, inject } from 'mobx-react';
import { withRouter } from "react-router";
import ReactMarkdown from "react-markdown";

// withRouter用于接收参数 this.props.match.params.id
// store用于访问appstate
@withRouter
@inject("store")
@observer
export default class Resume extends Component 
{
  constructor( props )
  {
      super( props );
      this.state = {"title":"","content":""};
  }

  async componentDidMount()
  {
    const data = await this.props.store.get_curr_resume(this.props.match.params.id);
   
    // console.log( data.code );

    if( parseInt( data.code , 10 ) === 0  )
    {
      this.setState( {"title":data.data.title} );
      this.setState( {"content":data.data.content} );
    }
    else
        alert( data.err );  
    
  }

  render()
  {
    console.log(this.state.title+"..");
    return <div>
        <h1>{this.state.title}</h1>
        {/* markdown语法不生效 */}
        <ReactMarkdown source={ this.state.content } />
        {/* <div dangerouslySetInnerHTML={{ __html: this.state.content }}></div> */}
      </div>;
  }
}

// export default Resume;
