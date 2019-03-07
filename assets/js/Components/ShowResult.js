import React from 'react';
import SortableComponent from "./PlanningTab";
import '../../css/ShowResult.css'

function ShowResult(props){
    const notes = props.notes;
    const listNotes = Object.keys(notes).map((note, index, tab)=>
        <li key={index}>Equipe {note} = <span>{notes[note]}</span></li>
    );
    return(
        <ol>{listNotes}</ol>
    )
}

export default ShowResult;