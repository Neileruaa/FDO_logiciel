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

        this.data = [
            ["", "Ford", "Volvo", "Toyota", "Honda"],
            ["2016", 10, 11, 12, 13],
            ["2017", 20, 11, 14, 13],
            ["2018", 30, 15, 12, 13]
        ];
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
                <HotTable data={this.state.testData} minSpareRows={1} />
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));