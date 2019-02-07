import React from 'react';
import SortableComponent from "./SortableComponent";

const PlanningTab = ({todo, onSortEnd, handleSelectPiste, handleSelectPassageSimul, handleSelectNumTour, handleSelectNbJudge}) =>(
    <SortableComponent
        todo={todo}
        onSortEnd={onSortEnd}
        handleSelectPiste={handleSelectPiste}
        handleSelectPassageSimul={handleSelectPassageSimul}
        handleSelectNumTour={handleSelectNumTour}
        handleSelectNbJudge={handleSelectNbJudge}
    />
);

export default PlanningTab;