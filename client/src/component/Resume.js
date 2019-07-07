import React, { Component }  from 'react';
import { observer, inject } from 'mobx-react';
import { withRouter } from "react-router";
// import ReactMarkdown from "react-markdown";

@withRouter
@inject("store")
@observer
export default class Resume extends Component {

  componentDidMount()
  {
    this.props.store.get_curr_resume(this.props.match.params.id);
  }

  render()
  {
    const resume_title = this.props.store.curr_resume_title;
    const resume_content = this.props.store.curr_resume_content;
    return <div>
        <h1>{resume_title}</h1>
        {/* <ReactMarkdown source={ resume_content } /> */}
        <div dangerouslySetInnerHTML={{ __html: resume_content }}></div>
      </div>;
  }
}

// export default Resume;
