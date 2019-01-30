import React from 'react';
import ReactDOM from 'react-dom';

import TodoTab from './Components/TodoTab';
import PlanningTab from './Components/PlanningTab'
import {arrayMove} from "react-sortable-hoc";
import axios from 'axios';

class ResultApp extends React.Component{
    constructor(props){
        super(props);

    }
    render() {
        return(
            <div>
                <h1>Test</h1>
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));