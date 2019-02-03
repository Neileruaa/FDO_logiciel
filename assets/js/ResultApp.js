import React from 'react';
import ReactDOM from 'react-dom';
import {HotTable} from "@handsontable/react";
import axios from "axios";


class ResultApp extends React.Component{
    constructor(props){
        super(props);

        this.state={
            testData: [],
        };
    }

    componentDidMount() {
        axios.get('http://127.0.0.1:8000/testAjax')
            .then(res=>{
                setTimeout(()=>{
                    this.setState({
                        testData: res.data.row.map(Object.values),
                    });
                    console.log(this.state.testData);
                }, 200);
            })
            .catch(err=>{
                console.log(err)
            })
    }

    render() {
        return(
            <div className="hot-app">
                <h1>Affichage des résultats</h1>
                <HotTable data={this.state.testData} colHeaders={true} rowHeaders={true} stretchH="all" width="auto"/>
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));