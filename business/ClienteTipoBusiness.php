<?php

require '../data/ConectaBDClienteTipo.php';

class ClienteTipoBusiness {
    
    public $ConectaBDClienteTipo;

    public function __construct() {
        $this->ConectaBDClienteTipo = new ConectaBDClienteTipo();
    }
    public function insertClienteTipo($clienteTipo) {
        return $this->ConectaBDClienteTipo->insertClienteTipo($clienteTipo);
    }

    public function updateClienteTipo($clienteTipo ) {
        return $this->ConectaBDClienteTipo->updateClienteTipo( $clienteTipo );
    }

    public function deleteClienteTipo($id, $clienteTipoActivo) {
        return $this->ConectaBDClienteTipo->deleteClienteTipo($id, $clienteTipoActivo);
    }

    public function getAllClienteTipo() {
        return $this->ConectaBDClienteTipo->getAllClienteTipo();
    }

    public function getOneClienteTipo($id) {
        return $this->ConectaBDClienteTipo->getOneClienteTipo($id);
    }

   
}

?>

