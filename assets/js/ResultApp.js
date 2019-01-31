import React from 'react';
import ReactDOM from 'react-dom';
import {HotTable} from "@handsontable/react";


class ResultApp extends React.Component{
    constructor(props){
        super(props);
        this.data = [
            ["", "Ford", "Volvo", "Toyota", "Honda"],
            ["2016", 10, 11, 12, 13],
            ["2017", 20, 11, 14, 13],
            ["2018", 30, 15, 12, 13]
        ];
    }
    render() {
        return(
            <div className="hot-app">
                <h1>Affichage des résultats</h1>
                <HotTable data={this.data} colHeaders={true} rowHeaders={true} width="auto" height="600" stretchH="all" />
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));