import React from 'react';

const TodoTab = ({todo, addRow}) =>(
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
        {todo.map(
            ({id, Dance, Categorie, Age, Round, Piste})=>
                <tr key={id}>
                    <th scope="row">{id}</th>
                    <td>{Dance}</td>
                    <td>{Categorie}</td>
                    <td>{Age}</td>
                    <td>{Round}</td>
                    <td>{Piste}</td>
                    <td><button onClick={() => addRow({id:id, Dance:Dance, Categorie:Categorie, Age:Age, Round:Round, Piste:Piste}, id)} className="btn btn-success"><i className="fas fa-plus"/></button></td>
                </tr>
        )}
        </tbody>
    </table>
);

export default TodoTab;