import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, onSortEnd, handleSelectPiste, handleSelectPassageSimul}) =>(
    <SortableComponent
        todo={todo}
        onSortEnd={onSortEnd}
        handleSelectPiste={handleSelectPiste}
        handleSelectPassageSimul={handleSelectPassageSimul}
    />
);

export default PlanningTab;