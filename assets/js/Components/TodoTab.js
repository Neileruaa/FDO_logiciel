import React from 'react';

const TodoTab = ({todo, addRow}) =>(
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
                    <td><button onClick={() => addRow({id:id, numTeam:numTeam, isPresent:isPresent, round:round}, id)} className="btn btn-success"><i className="fas fa-plus"/></button></td>
                </tr>
        )}
        </tbody>
    </table>
);

export default TodoTab;