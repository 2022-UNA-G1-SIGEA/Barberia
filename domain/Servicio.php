<?php

class Servicio
{
    private $idServicio;
    private $nombre;
    private $descripcion;
    private $activo;

    //contructor de la clase
    public function __construct($args=[])
    {
        $this->idServicio = $args['idServicio'] ??'';
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->activo = $args['activo'] ?? '';
    }

    //getters y setters
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }   

}
