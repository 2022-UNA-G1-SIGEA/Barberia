<?php

include '../data/ConectaBDTarifa.php';


class TarifaBusiness {
    
    public $ConectaBD;

    public function __construct() {
        $this->ConectaBD = new ConectaBDTarifa();
    }
    public function insertTarifa($tarifa) {
        return $this->ConectaBD->insertTarifa($tarifa);
    }

    public function updatetarifa($tarifa) {
        return $this->ConectaBD->updateTarifa($tarifa);
    }

    public function deleteTarifa($idtarifa,$activo) {
        return $this->ConectaBD->deleteTarifa($idtarifa,$activo);
    }

    public function getAllTarifa() {
        return $this->ConectaBD->getAllTarifa();
    }

    public function getTarifa($idtarifa) {
        return $this->ConectaBD->getOneTarifa( $idtarifa);
    }

   
}