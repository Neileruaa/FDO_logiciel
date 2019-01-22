/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/Montserrat.css');

require('../css/app.scss');

const $ = require('jquery');

require('bootstrap');

require('sorttable');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

import React from 'react';
import ReactDOM from 'react-dom';

import TodoTab from './Components/TodoTab';
import PlanningTab from './Components/PlanningTab'

class App extends React.Component{
    constructor(props){
        super(props);
        this.state={
            todo: [
                {id: 0, numTeam: 0, isPresent:0, round:1},
                {id: 1, numTeam: 1, isPresent:1, round:1},
                {id: 2, numTeam: 2, isPresent:1, round:2},
                {id: 3, numTeam: 3, isPresent:0, round:"Finale"},
            ],
            done: []
        };

        this.addRow = this.addRow.bind(this);
        this.removeRow = this.removeRow.bind(this);
    }

    componentDidMount() {
        // fetch('https://jsonplaceholder.typicode.com/posts/')
        //     .then(response => response.json())
        //     .then(entries => {
        //         this.setState({
        //             entries
        //         });
        //     });
    }

    addRow(newRow, id){
        this.state.done.push(newRow);
        this.state.todo.map(
            (row, index)=>{
                if (row['id']===id){
                    console.log(row);
                    this.state.todo.splice(index, 1);
                }
            }
        )
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
                    console.log(row);
                    this.state.done.splice(index, 1);
                }
            }
        )
        this.setState({
            done: this.state.done,
            todo: this.state.todo
        });
    }

    render() {
        return(
            <div>
                {/*{this.state.entries.map(*/}
                    {/*({id,title,body})=>(*/}
                        {/*<Items*/}
                            {/*key={id}*/}
                            {/*title={title}*/}
                            {/*body={body}*/}
                        {/*/>*/}
                    {/*)*/}
                {/*)}*/}

                <TodoTab
                    todo={this.state.todo}
                    addRow={this.addRow}
                />

                <PlanningTab todo={this.state.done} removeRow={this.removeRow} />


            </div>
        );
    }
}

ReactDOM.render(<App/>, document.getElementById('root'));