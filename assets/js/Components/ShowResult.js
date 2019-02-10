import React from 'react';
import SortableComponent from "./PlanningTab";


function ShowResult(props){
    const notes = props.notes;
    const listNotes = notes.map((note, index, tab)=>
        <li key={index}>Equipe {index} = {note}</li>
    );
    return(
        <ul>{listNotes}</ul>
    )
}

export default ShowResult;