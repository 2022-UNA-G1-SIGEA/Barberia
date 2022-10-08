<?php 
    class Factura {
        public $idFactura;
        public $fecha;
        public $cliente;
   
        public function __construct($argc=[]) {
            $this->idFactura  = $argc['idFactura'] ?? '';
            $this->fecha = $argc['fecha'] ?? '';
            $this->cliente  = $argc['cliente'] ?? '';
        }

        //set
        public function setIdFactura($idFactura) {
            $this->idFactura = $idFactura;
        }
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
        public function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        //get
        public function getIdFactura() {
            return $this->idFactura;
        }

        public function getFecha() {
            return $this->fecha;
        }

        public function getCliente() {
            return $this->cliente;
        }

    }
