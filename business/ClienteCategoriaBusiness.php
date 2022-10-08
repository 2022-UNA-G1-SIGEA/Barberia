<?php
require '../data/ConectaBDClienteCategoria.php';
class ClienteCategoriaBusiness{
    public $ConectaBDClienteCategoria;

    public function __construct() {
        $this->ConectaBDClienteCategoria = new ConectaBDClienteCategoria();
    }
    public function insertClientCategory($clienteCategoria) {   
        return $this->ConectaBDClienteCategoria->insertClientCategory($clienteCategoria);

    }

    public function updateClientCategory($clienteCategoria) {
        return $this->ConectaBDClienteCategoria->updateClientCategory($clienteCategoria);
    }

    public function deleteClientCategory($idClienteCategoria, $activo) {
        return $this->ConectaBDClienteCategoria->deleteClientCategory($idClienteCategoria, $activo);
    }


    public function getAllClientCategory() {
        return $this->ConectaBDClienteCategoria->getAllClientCategory();
    }

    public function getAllClientCategoryNoActivo() {
        return $this->ConectaBDClienteCategoria->getAllClientCategoryNoActivo();
    }

    public function getOneClientCategory($idClienteCategoria) {
        return $this->ConectaBDClienteCategoria->getOneClientCategory($idClienteCategoria);
    }

    

    
}

?>