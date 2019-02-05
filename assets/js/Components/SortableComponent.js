import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
} from 'react-sortable-hoc';

const SortableItem = SortableElement(({nameDance, nameCategory, size, round, piste, index, handleSelectPiste}) => (
    <tr key={index}>
        <td>{nameDance}</td>
        <td>{size}</td>
        <td>{nameCategory}</td>
        <td>{round}</td>
        <td>{piste}</td>
        <td>
            <button type="button" className="btn btn-primary" data-toggle="modal" data-target={"#exampleModal"+index}><i className="fas fa-cogs"/></button>


            <div className="modal fade" id={"exampleModal"+index} tabIndex="-1" role="dialog"
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
                            <select id="choisirPiste" value={piste} onChange={()=>handleSelectPiste(event, index)}>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
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
                    <th scope="col">Danse</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Age</th>
                    <th scope="col">Tour</th>
                    <th scope="col">Pistes</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                {todo.map(({nameDance, nameCategory, size, round, piste}, index) => (
                    <SortableItem
                        key={`item-${index}`}
                        index={index}
                        nameDance={nameDance}
                        size={size}
                        nameCategory={nameCategory}
                        round={round}
                        piste={piste}
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
            handleSelectPiste={this.props.handleSelectPiste}/>;
    }
}