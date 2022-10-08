<?php

include '../data/ConectaBDServicio.php';


class ServicioBusiness {
    
    public $ConectaBDServicio;

    public function __construct() {
        $this->ConectaBDServicio = new ConectaBDServicio();
    }
    public function insertServicio($servicio) {
        return $this->ConectaBDServicio->insertServicio( $servicio );
    }

    public function updateServicio( $servicio ) {
        return $this->ConectaBDServicio->updateServicio( $servicio );
    }

    public function deleteServicio($idServicio, $activo) {
        return $this->ConectaBDServicio->deleteServicio($idServicio,$activo);
    }

    public function getAllServicios() {
        return $this->ConectaBDServicio->getAllServicios();
    }

    public function getOneServicio($idServicio) {
        return $this->ConectaBDServicio->getOneServicio( $idServicio);
    }

   
}