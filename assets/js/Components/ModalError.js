import React from 'react';
import Modal from 'react-bootstrap/Modal'
import Button from "react-bootstrap/Button";

const ModalError = ({ handleClose, show, title, content }) => {
    return (
        <Modal show={show} onHide={handleClose}>
            <Modal.Header>
                <Modal.Title>{title}</Modal.Title>
            </Modal.Header>
            <Modal.Body>{content}</Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={handleClose}>D'accord très bien j'ai compris</Button>
            </Modal.Footer>
        </Modal>
    );
};

export default ModalError;