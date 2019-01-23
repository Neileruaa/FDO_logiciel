import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
} from 'react-sortable-hoc';

const SortableItem = SortableElement(({id, numTeam, isPresent, round, index, removeRow}) => (
    <tr key={id}>
        <th scope="row">{id}</th>
        <td>{numTeam}</td>
        <td>{isPresent}</td>
        <td>{round}</td>
        <td><button onClick={() => removeRow({id:id, numTeam:numTeam, isPresent:isPresent, round:round}, id)} className="btn btn-danger"><i className="fas fa-minus"/></button></td>
    </tr>
));

const SortableList = SortableContainer(({todo, removeRow}) => {
    return (
        <table className="sortable table table-striped table-hover">
            <thead>
                <tr key="id">
                    <th scope="col">#</th>
                    <th scope="col">Num Team</th>
                    <th scope="col">is Present</th>
                    <th scope="col">Round?</th>
                </tr>
            </thead>
            <tbody>
                {todo.map(({id, numTeam, isPresent, round}, index) => (
                    <SortableItem key={`item-${id}`} index={index} id={id} numTeam={numTeam} isPresent={isPresent} round={round} removeRow={removeRow} />
                ))}
            </tbody>
        </table>
    );
});

export default class SortableComponent extends Component {
    constructor(props){
        super(props);
    }

    render() {
        return <SortableList todo={this.props.todo} onSortEnd={this.props.onSortEnd} removeRow={this.props.removeRow} />;
    }
}