import React from 'react';
import ReactDOM from 'react-dom';
import {HotTable} from "@handsontable/react";
import axios from "axios";
import ShowResult from './Components/ShowResult'



class ResultApp extends React.Component{
    constructor(props){
        super(props);

        this.state={
            sheet: [],
            notes: []
        };

        this.hotTableComponent = React.createRef();
        this.doCalc = this.doCalc.bind(this);
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
        var line = ["1"];
        line.length = judges.length;
        line.fill(0,1);
        this.state.sheet.push(line);

        var line2 = ["6"];
        line2.length = judges.length;
        line2.fill(0,1);
        this.state.sheet.push(line2);

        var line3 = ["7"];
        line3.length = judges.length;
        line3.fill(0,1);
        this.state.sheet.push(line3);

        var line4 = ["8"];
        line4.length = judges.length;
        line4.fill(0,1);
        this.state.sheet.push(line4);

        ///initialisation des notes
        // console.log(this.state.sheet);

        for (var j = 1; j<this.state.sheet.length; j++){
            this.state.notes[this.state.sheet[j][0]] = 0;
        }

        this.setState({
            sheet : this.state.sheet,
            notes : this.state.notes
        });
    }


    doCalc(){
        var self = this;
        this.hotTableComponent.current.hotInstance.updateSettings({
            afterChange: function (changes) {
                for (let j = 1; j<self.state.sheet.length; j++){
                    self.state.notes[self.state.sheet[j][0]] = 0;
                }

                for(let i = 1; i<this.getData().length; i++){
                    // self.state.notes[this.getData()[i][0]]
                    for(let j = 1; j<this.getData()[0].length; j++){
                        self.state.notes[this.getData()[i][0]] += parseInt(this.getData()[i][j]);
                    }
                    console.log(self.state.notes[this.getData()[i][0]]);
                    self.state.notes[this.getData()[i][0]] /= this.getData()[0].length-1;
                    console.log(self.state.notes[this.getData()[i][0]]);
                }
            }
        });
        this.setState({notes:this.state.notes});
    }

    render() {
        return(
            <div className="hot-app">
                <h1>Affichage des résultats</h1>
                <HotTable
                    data={this.state.sheet}
                    stretchH="all"
                    width="auto"
                    ref={this.hotTableComponent}
                    cells={function (row, col, prop) {
                        var cellProperties = {};
                            if (col ===0) {
                                cellProperties.readOnly = 'true'
                            }
                        if (row===0) {
                            cellProperties.readOnly = 'true'
                        }
                        return cellProperties
                    }
                    }
                />
                <button onClick={this.doCalc}>Calculer les moyennes</button>

                <ShowResult
                    notes={this.state.notes}
                />
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));