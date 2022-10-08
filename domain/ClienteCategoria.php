<?php   
class ClienteCategoria{

    private $idclientecategoria;
    private $nombre;
    private $descripcion;
    public $activo;

    public function __construct($args=[]) {
        $this->idclientecategoria = $args['idclientecategoria'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->activo = $args['activo'] ?? '';
    }

    public function getIdclientecategoria() {
        return $this->idclientecategoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setIdclientecategoria($idclientecategoria) {
        $this->idclientecategoria = $idclientecategoria;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    
}
