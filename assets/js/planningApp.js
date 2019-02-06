import React from 'react';
import ReactDOM from 'react-dom';

import PlanningTab from './Components/PlanningTab'
import {arrayMove} from "react-sortable-hoc";
import axios from 'axios';

class App extends React.Component{
    constructor(props){
        super(props);
        this.state={
            error:null,
            todo: [],
            isLoaded:false,
            done: []
        };

        this.testClick2 = this.testClick2.bind(this);
        this.handleSelectPiste = this.handleSelectPiste.bind(this);
        this.handleSelectPassageSimul= this.handleSelectPassageSimul.bind(this);
        this.handleSelectNumTour= this.handleSelectNumTour.bind(this);
    }

    componentDidMount() {
        axios.get('http://127.0.0.1:8000/testAjax')
            .then(res=>{
                setTimeout(()=>{
                    // console.log(res.data.row);
                    this.setState({
                        done: res.data.row,
                        isLoaded: true,
                    })
                }, 200);
            })
            .catch(err=>{
                console.log(err);
                this.setState({
                    error:err,
                    isLoaded: true
                })
            })
    }

    onSortEnd = ({oldIndex, newIndex}) =>{
        this.setState(({done})=>({
            done: arrayMove(done, oldIndex, newIndex)
        }));
    };

    testClick2(){
        axios.post('http://127.0.0.1:8000/testAjaxPost',{
            rows: this.state.done
        }).then(res=>{
            console.log(res);
            this.button.setAttribute("class", "btn btn-success");
        }).catch(err=>{
            this.button.setAttribute("class", "btn btn-danger");
            console.log(err);
        })
    }

    handleSelectPiste(event, id){
        this.state.done.map(
            (row, index)=>{
                if (row['id'] === id){
                    this.state.done.find(x => x.id ===id).piste= event.target.value;
                }
            }
        );
        this.setState({
            done:this.state.done,
        });
    }

    handleSelectPassageSimul(event, id){
        this.state.done.map(
            (row, index)=>{
                if (row['id'] === id){
                    this.state.done.find(x => x.id ===id).passageSimul= event.target.value;
                }
            }
        );
        this.setState({
            done:this.state.done,
        });
    }

    handleSelectNumTour(event, id){
        this.state.done.map(
            (row, index)=>{
                if (row['id'] === id){
                    this.state.done.find(x => x.id ===id).numTour= event.target.value;
                }
            }
        );
        this.setState({
            done:this.state.done,
        });
    }

    render() {
        if (!this.state.isLoaded){
            return(
                <div className="spinner-border" role="status">
                    <span className="sr-only">Loading...</span>
                </div>
            );
        } else{
            return(
                <div>
                    <PlanningTab
                        todo={this.state.done}
                        onSortEnd={this.onSortEnd}
                        handleSelectPiste={this.handleSelectPiste}
                        handleSelectPassageSimul={this.handleSelectPassageSimul}
                        handleSelectNumTour={this.handleSelectNumTour}
                    />

                    <button className="btn btn-info" ref={buttonValider=>{this.button=buttonValider}} onClick={this.testClick2}>Valider</button>
                </div>
            );
        }
    }
}

ReactDOM.render(<App/>, document.getElementById('planningCreator'));