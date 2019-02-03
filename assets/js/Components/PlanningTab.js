import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, removeRow, onSortEnd, handleSelectPiste}) =>(
    <SortableComponent
        todo={todo}
        onSortEnd={onSortEnd}
        removeRow={removeRow}
        handleSelectPiste={handleSelectPiste}/>
);

export default PlanningTab;