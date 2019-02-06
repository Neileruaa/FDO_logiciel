import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
} from 'react-sortable-hoc';

const SortableItem = SortableElement(({id,dance, category, formation, numTour, piste, index, handleSelectPiste, passageSimul, handleSelectPassageSimul}) => (
    <tr key={index}>
        <td>{dance['nameDance']}</td>
        <td>{formation}</td>
        <td>{category['nameCategory']}</td>
        <td>{numTour}</td>
        <td>{piste}</td>
        <td>
            <button type="button" className="btn btn-primary" data-toggle="modal" data-target={"#exampleModal"+id}><i className="fas fa-cogs"/></button>


            <div className="modal fade" id={"exampleModal"+id} tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <select name="piste" id="choisirPiste" value={piste} onChange={()=>handleSelectPiste(event, id)}>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                            </select>
                            <hr/>
                            <label htmlFor="choisirPassageSimul">Choisir nb danseurs simultanés :</label>
                            <input type="text" value={passageSimul} id="choisirPassageSimul" onChange={()=>handleSelectPassageSimul(event, id)}/>
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

const SortableList = SortableContainer(({todo, removeRow, handleSelectPiste, handleSelectPassageSimul}) => {
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
                {todo.map(({id, dance, category, formation, numTour, piste, passageSimul}, index) => (
                    <SortableItem
                        key={`item-${index}`}
                        id={id}
                        index={index}
                        dance={dance}
                        formation={formation}
                        category={category}
                        numTour={numTour}
                        piste={piste}
                        passageSimul={passageSimul}
                        removeRow={removeRow}
                        handleSelectPassageSimul={handleSelectPassageSimul}
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
            handleSelectPassageSimul={this.props.handleSelectPassageSimul}
            handleSelectPiste={this.props.handleSelectPiste}
            distance={10}
        />;
    }
}