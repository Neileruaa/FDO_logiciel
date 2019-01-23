import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
    arrayMove,
} from 'react-sortable-hoc';

const SortableItem = SortableElement(({id, numTeam, isPresent, round, index}) => (
    <tr key={id}>
        <th scope="row">{id}</th>
        <td>{numTeam}</td>
        <td>{isPresent}</td>
        <td>{round}</td>
    </tr>
));

const SortableList = SortableContainer(({todo}) => {
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
                    <SortableItem key={`item-${id}`} index={index} id={id} numTeam={numTeam} isPresent={isPresent} round={round} />
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
        return <SortableList todo={this.props.todo} onSortEnd={this.props.onSortEnd} />;
    }
}