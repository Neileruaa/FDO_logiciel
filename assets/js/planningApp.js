import React from 'react';
import ReactDOM from 'react-dom';

import TodoTab from './Components/TodoTab';
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

        this.addRow = this.addRow.bind(this);
        this.removeRow = this.removeRow.bind(this);
        this.testClick2 = this.testClick2.bind(this);
    }

    componentDidMount() {
        axios.get('http://127.0.0.1:8000/testAjax')
            .then(res=>{
                setTimeout(()=>{
                    // console.log(res.data.row);
                    this.setState({
                        todo: res.data.row,
                        isLoaded: true
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

    addRow(newRow, id){
        this.state.done.push(newRow);
        this.state.todo.map(
            (row, index)=>{
                if (row['id']===id){
                    this.state.todo.splice(index, 1);
                }
            }
        );
        this.setState({
            done: this.state.done,
            todo: this.state.todo
        });
    }

    removeRow(newRow, id){
        this.state.todo.push(newRow);
        this.state.done.map(
            (row, index)=>{
                if (row['id']===id){
                    this.state.done.splice(index, 1);
                }
            }
        );
        this.setState({
            done: this.state.done,
            todo: this.state.todo
        });
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
                    <TodoTab
                        todo={this.state.todo}
                        addRow={this.addRow}
                    />

                    <PlanningTab todo={this.state.done} removeRow={this.removeRow} onSortEnd={this.onSortEnd} />

                    <button className="btn btn-info" ref={buttonValider=>{this.button=buttonValider}} onClick={this.testClick2}>Valider</button>
                </div>
            );
        }
    }
}

ReactDOM.render(<App/>, document.getElementById('planningCreator'));