// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class DiviBreadcrumbs extends Component {

  static slug = 'et_pb_dcsbcm_divi_breadcrumbs_module';

  render() {

    console.log("JSX render()", this.props);
    return (<div className="jsx_wrapper" dangerouslySetInnerHTML={{  __html: this.props.computed_field_html_payload }}></div>);

  }
}

export default DiviBreadcrumbs;
