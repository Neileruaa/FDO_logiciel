import React from 'react';
import ReactDOM from 'react-dom';
import {HotTable} from "@handsontable/react";
import axios from "axios";
import ShowResult from './Components/ShowResult'
// import _ from 'lodash';
import _ from 'underscore';

class ResultApp extends React.Component{
    constructor(props){
        super(props);

        this.state= {
            sheet: [],
            notes: {},
            nbQualifie: 2,
            nextRound:""
        };

        this.hotTableComponent = React.createRef();
        this.doCalc = this.doCalc.bind(this);
        this.handleRangeNbQualifie = this.handleRangeNbQualifie.bind(this);
        this.handleSelectNextRound= this.handleSelectNextRound.bind(this);
        this.createNextRound= this.createNextRound.bind(this);
    }

    componentDidMount() {
        var self = this;
        this.hotTableComponent.current.hotInstance.updateSettings({
            afterChange: function (changes) {
                for (let nbTeam in self.state.sheet){
                    if (self.state.sheet[nbTeam][0] !== "" && self.state.sheet[nbTeam][0] !== 0 ) {
                        self.state.notes[self.state.sheet[nbTeam][0]] = 0;
                    }
                }

                for(let i = 1; i<this.getData().length; i++){
                    for(let j = 1; j<this.getData()[0].length; j++){
                        self.state.notes[this.getData()[i][0]] += parseInt(this.getData()[i][j]);
                    }
                    self.state.notes[this.getData()[i][0]] /= this.getData()[0].length-1;

                }
            },
        });


        const  nbJudge = document.getElementById("resultatApp").getAttribute("data-row-nbJudge");

        let judges = [""];
        
        for (var i=1; i<=nbJudge; i++){
            judges.push((i + 9).toString(36).toUpperCase());
        }
        this.state.sheet.push(judges);

        //Recupere les équipes
        const idRow = document.getElementById("resultatApp").getAttribute("data-row-id");
        axios.get('http://127.0.0.1:8000/row/getAllTeamById',{
            params:{
                id: idRow
            }
        })
            .then(function (res) {
                for (let nbTeam of res.data.Res){
                    var line = [];
                    line.push(nbTeam.toString());
                    line.length = judges.length;
                    line.fill(0,1);
                    self.state.sheet.push(line);
                    self.setState({sheet: self.state.sheet});
                }
                // for (var j = 1; j<self.state.sheet.length; j++){
                //     self.state.notes[self.state.sheet[j][0]] = 0;
                // }
            })
            .catch(function (err) {
                console.log(err);
            });

        this.setState({
            sheet : this.state.sheet,
            notes : this.state.notes
        });
    }

    doCalc(){
        var tabNotes = [];
        for (var note in this.state.notes){
            tabNotes.push([note, this.state.notes[note]]);
        }
        tabNotes.sort(function (a,b) {
           return b[1] - a[1];
        });
        this.setState({notes: this.objectify(tabNotes)});
    }

     objectify(array) {
        return array.reduce(function(p, c) {
            p[c[0]] = c[1];
            return p;
        }, {});
    }

    handleRangeNbQualifie(e){
        this.setState({nbQualifie: e.target.value});
    }

    handleSelectNextRound(e){
        this.setState({nextRound:e.target.value})
    }

    createNextRound(){
        axios.post('http://127.0.0.1:8000/create/rows/afterResult', {
            nextRound: this.state.nextRound,
            rowId : document.getElementById("resultatApp").getAttribute("data-row-id"),
            notes: this.state.notes,
            nbQualifie: this.state.nbQualifie
        })
            .then(function (response) {
                // window.location.href = "http://127.0.0.1:8000/planning/actuel";
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    render() {

        var tour = "";
        if (this.state.nextRound === ""){
            tour = document.getElementById("resultatApp").getAttribute("data-row-numTour");
        }else
            tour = this.state.nextRound;

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
                <button onClick={this.doCalc} className="btn btn-outline-primary">Calculer les moyennes</button>
                <br/>
                <div>
                    <label htmlFor="chooseNbQualifie">Choisir nombres de personnes qualifiés : {this.state.nbQualifie}</label>
                    <input id="chooseNbQualifie" type="range" value={this.state.nbQualifie} className="custom-range" onChange={this.handleRangeNbQualifie} min="2"/>
                </div>
                <div>
                    <label htmlFor="choisirPiste">Choisir un type de tour:</label>
                    <select name="piste" id="choisirPiste" value={tour} onChange={this.handleSelectNextRound}>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="Huitieme" >Huitième</option>
                        <option value="Quart" >Quart de finale</option>
                        <option value="Demi" >Demi finale</option>
                        <option value="Finale" >Finale</option>
                    </select>
                </div>
                <button onClick={this.createNextRound} className="btn btn-success">Valider ces résultats</button>
                <ShowResult
                    notes={this.state.notes}
                />
            </div>
        );
    }
}

ReactDOM.render(<ResultApp/>, document.getElementById('resultatApp'));