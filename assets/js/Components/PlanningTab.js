import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, removeRow}) =>(
    <div>
        <table className="sortable table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Num Team</th>
                <th scope="col">is Present</th>
                <th scope="col">Round?</th>
            </tr>
            </thead>
            <tbody>
            {todo.map(
                ({id, numTeam, isPresent, round})=>
                    <tr key={id}>
                        <th scope="row">{id}</th>
                        <td>{numTeam}</td>
                        <td>{isPresent}</td>
                        <td>{round}</td>
                        <td><button className="btn btn-danger" onClick={() => removeRow({id:id, numTeam:numTeam, isPresent:isPresent, round:round}, id)}><i className="fas fa-minus"/></button></td>
                    </tr>
            )}
            </tbody>
        </table>
        <SortableComponent/>
    </div>
);

export default PlanningTab;