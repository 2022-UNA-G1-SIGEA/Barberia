<?php

require '../data/ConectaBDCliente.php';
class ClienteBusiness{
    //contructor inicializado variable 

    public function __construct() {
        $this->ConectaBDCliente = new ConectaBDCliente();
    }

    public function insertCliente($cliente) {   
        return $this->ConectaBDCliente->insertCliente($cliente);
    }


    public function updateCliente($cliente) {
        return $this->ConectaBDCliente->updateCliente($cliente);
    }

    public function deleteCliente($idcliente) {
        return $this->ConectaBDCliente->deleteCliente($idcliente);
    }

    public function getAllCliente() {
        return $this->ConectaBDCliente->getAllCliente();
    }

    public function getAllClienteNoActivo() {
        return $this->ConectaBDCliente->getAllClienteNoActivo();
    }

    public function getOneCliente($idcliente) {
        return $this->ConectaBDCliente->getOneCliente($idcliente);
    }

    public function getClienteActivo() {
        return $this->ConectaBDCliente->getClienteActivo();
    } 

    public function getClienteNoActivo() {
        return $this->ConectaBDCliente->getClienteNoActivo();
    }

}

?>