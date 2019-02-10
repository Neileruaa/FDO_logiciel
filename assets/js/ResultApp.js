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

    componentDidMount() {
        //Recupere les équipes
        const idRow = document.getElementById("resultatApp").getAttribute("data-row-id");
        axios.get('http://127.0.0.1:8000/row/getAllTeamById',{
            params:{
                id: idRow
            }
        })
            .then(function (res) {
                console.log(res.data);
            })
            .catch(function (err) {
                console.log(err);
            });


        const  nbJudge = document.getElementById("resultatApp").getAttribute("data-row-nbJudge");

        let judges = [""];
        
        for (var i=1; i<=nbJudge; i++){
            judges.push((i + 9).toString(36).toUpperCase());
        }
        this.state.sheet.push(judges);


        //fake datas
        var line = ["Equipe 1"];
        line.length = judges.length;
        line.fill("0",1);
        this.state.sheet.push(line);

        var line2 = ["Equipe 2"];
        line2.length = judges.length;
        line2.fill("0",1);
        this.state.sheet.push(line2);

        var line3 = ["Equipe 3"];
        line3.length = judges.length;
        line3.fill("0",1);
        this.state.sheet.push(line3);

        var line4 = ["Equipe 4"];
        line4.length = judges.length;
        line4.fill("0",1);
        this.state.sheet.push(line4);

        this.setState({
            sheet : this.state.sheet
        });
    }

    render() {
        return(
            <div className="hot-app">
                <h1>Affichage des résultats</h1>
                <HotTable
                    data={this.state.sheet}
                    stretchH="all"
                    width="auto"
                />
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));