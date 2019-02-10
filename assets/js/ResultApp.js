import React from 'react';
import ReactDOM from 'react-dom';
import {HotTable} from "@handsontable/react";
import axios from "axios";


class ResultApp extends React.Component{
    constructor(props){
        super(props);

        this.state={
            sheet: [],
        };
    }

    componentWillMount() {
        const  nbJudge = document.getElementById("resultatApp").getAttribute("data-row-nbJudge");

        let judges = [""];
        
        for (var i=1; i<=nbJudge; i++){
            judges.push((i + 9).toString(36).toUpperCase());
        }
        this.state.sheet.push(judges);
        this.setState({
            sheet : this.state.sheet
        });
    }

    render() {
        console.log(this.state.sheet);
        return(
            <div className="hot-app">
                <h1>Affichage des résultats</h1>
                <HotTable
                    data={this.state.sheet}
                    colHeaders={true}
                    rowHeaders={true}
                    stretchH="all"
                    width="auto"
                />
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));