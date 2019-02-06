import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, onSortEnd, handleSelectPiste, handleSelectPassageSimul, handleSelectNumTour}) =>(
    <SortableComponent
        todo={todo}
        onSortEnd={onSortEnd}
        handleSelectPiste={handleSelectPiste}
        handleSelectPassageSimul={handleSelectPassageSimul}
        handleSelectNumTour={handleSelectNumTour}
    />
);

export default PlanningTab;