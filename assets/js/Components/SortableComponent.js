import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
} from 'react-sortable-hoc';

const SortableItem = SortableElement(({id, Dance, Categorie, Age, Round, Piste, index, removeRow}) => (
    <tr key={id}>
        <th scope="row">{id}</th>
        <td>{Dance}</td>
        <td>{Categorie}</td>
        <td>{Age}</td>
        <td>{Round}</td>
        <td>{Piste}</td>
        <td><button onClick={() => removeRow({id:id, Dance:Dance, Categorie:Categorie, Age:Age, Round:Round, Piste:Piste}, id)} className="btn btn-danger"><i className="fas fa-minus"/></button></td>
    </tr>
));

const SortableList = SortableContainer(({todo, removeRow}) => {
    return (
        <table className="sortable table table-striped table-hover">
            <thead>
                <tr key="id">
                    <th scope="col">#</th>
                    <th scope="col">Danse</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Age</th>
                    <th scope="col">Tour</th>
                    <th scope="col">Pistes</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                {todo.map(({id, Dance, Categorie, Age, Round, Piste}, index) => (
                    <SortableItem key={`item-${id}`} index={index} id={id} Dance={Dance} Categorie={Categorie} Age={Age} Round={Round} Piste={Piste} removeRow={removeRow} />
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