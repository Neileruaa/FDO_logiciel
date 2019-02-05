import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, onSortEnd, handleSelectPiste}) =>(
    <SortableComponent
        todo={todo}
        onSortEnd={onSortEnd}
        handleSelectPiste={handleSelectPiste}/>
);

export default PlanningTab;