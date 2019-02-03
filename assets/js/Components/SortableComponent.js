import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
} from 'react-sortable-hoc';

const SortableItem = SortableElement(({id, Dance, Categorie, Age, Round, Piste, index, removeRow, handleSelectPiste}) => (
    <tr key={id}>
        <th scope="row">{id}</th>
        <td>{Dance}</td>
        <td>{Categorie}</td>
        <td>{Age}</td>
        <td>{Round}</td>
        <td>{Piste}</td>
        <td>
            <button onClick={() => removeRow({id:id, Dance:Dance, Categorie:Categorie, Age:Age, Round:Round, Piste:Piste}, id)} className="btn btn-danger"><i className="fas fa-minus"/></button>
            <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i className="fas fa-cogs"/></button>


            <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="exampleModalLabel">Options</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <label htmlFor="choisirPiste">Choisir une piste:</label>
                            <select id="choisirPiste" value={Piste} onChange={()=>handleSelectPiste(event, id)}>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                            </select>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" className="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
));

const SortableList = SortableContainer(({todo, removeRow, handleSelectPiste}) => {
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
                    <SortableItem
                        key={`item-${id}`}
                        index={index}
                        id={id}
                        Dance={Dance}
                        Categorie={Categorie}
                        Age={Age}
                        Round={Round}
                        Piste={Piste}
                        removeRow={removeRow}
                        handleSelectPiste={handleSelectPiste}/>
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
        return <SortableList
            todo={this.props.todo}
            onSortEnd={this.props.onSortEnd}
            removeRow={this.props.removeRow}
            handleSelectPiste={this.props.handleSelectPiste}/>;
    }
}