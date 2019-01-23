import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, removeRow, onSortEnd}) =>(
    <SortableComponent todo={todo} onSortEnd={onSortEnd} removeRow={removeRow}/>
);

export default PlanningTab;