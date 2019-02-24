import React, {Component} from 'react';

import {
    SortableContainer,
    SortableElement,
} from 'react-sortable-hoc';
import sorttable from 'sorttable';


const SortableItem = SortableElement(({id,dance, category, formation, numTour, piste, index, handleSelectPiste, handleSelectNumTour, passageSimul, handleSelectPassageSimul, nbJudge, handleSelectNbJudge}) => (
    <tr key={index}>
        <td>{dance['nameDance']}</td>
        <td>{formation}</td>
        <td>{category['nameCategory']}</td>
        <td>{numTour}</td>
        <td>{piste}</td>
        <td>{passageSimul}</td>
        <td>{nbJudge}</td>
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
                            <select name="piste" id="choisirPiste" value={piste} onChange={(event)=>handleSelectPiste(event, id)}>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                            </select>
                            <hr/>
                            <label htmlFor="choisirPassageSimul">Choisir nb danseurs simultanés :</label>
                            <input type="number" min="1" max="16" value={passageSimul} id="choisirPassageSimul" onChange={(event)=>handleSelectPassageSimul(event, id)}/>
                            <hr/>
                            <label htmlFor="choisirNumTour">Choisir un type de tour:</label>
                            <select name="piste" id="choisirPiste" value={numTour} onChange={(event)=>handleSelectNumTour(event, id)}>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="Huitieme" >Huitième</option>
                                <option value="Quart" >Quart de finale</option>
                                <option value="Demi" >Demi finale</option>
                                <option value="Finale" >Finale</option>
                            </select>
                            <hr/>
                            <label htmlFor="rangeNumberJugde" id="test">Nombre de juges: {nbJudge} </label>
                            <input type="range" className="custom-range" min="3" max="15" step="2" id="rangeNumberJugde" value={nbJudge} onChange={(event)=>handleSelectNbJudge(event,id)}/>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-success" data-dismiss="modal">Terminer</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
));

const SortableList = SortableContainer(({todo, removeRow, handleSelectPiste, handleSelectPassageSimul, handleSelectNumTour, handleSelectNbJudge}) => {
    return (
        <table className="sortable table table-striped table-hover">
            <thead>
                <tr key="id">
                    <th scope="col">Danse</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Age</th>
                    <th scope="col">Tour</th>
                    <th scope="col">Pistes</th>
                    <th scope="col">Danseurs simultanés</th>
                    <th scope="col">Nb juges</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                {todo.map(({id, dance, category, formation, numTour, piste, passageSimul, nbJudge}, index) => (
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
                        nbJudge={nbJudge}
                        removeRow={removeRow}
                        handleSelectPassageSimul={handleSelectPassageSimul}
                        handleSelectPiste={handleSelectPiste}
                        handleSelectNumTour={handleSelectNumTour}
                        handleSelectNbJudge={handleSelectNbJudge}
                    />
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
            handleSelectNumTour={this.props.handleSelectNumTour}
            handleSelectNbJudge={this.props.handleSelectNbJudge}
            distance={10}
        />;
    }
}