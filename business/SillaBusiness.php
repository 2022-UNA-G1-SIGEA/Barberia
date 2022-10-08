<?php

require '../data/ConectaBDSilla.php';


class SillaBusiness {

    public $ConectaBD;

    public function __construct() {
        $this->ConectaBD = new ConectaBDSilla();
    }

    public function insertChair($chair) {

        return $this->ConectaBD->insertChair($chair);
    }

    public function updateChair($chair) {
        return $this->ConectaBD->updateChair($chair);
    }

    public function deleteChair($idChair,$activo) {
        return $this->ConectaBD->deleteChair($idChair,$activo);
    }

    public function getAllChair() {

    
        return $this->ConectaBD->getAllChair();
     
    }

    public function getAllChairNoActivo() {
        return $this->ConectaBD->getAllChairNoActivo();
    }

    public function getOneChair($idChair) {
        return $this->ConectaBD->getOneChair($idChair);
    }



   
}

