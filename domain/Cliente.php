<?php
class Cliente
{
    public $idcliente;
    public $nombre;
    public $apellido;
    public $correo;
    public $numeroTelefono;
    public $activo;

    function __construct($args = [])
    {
        $this->idcliente = $args['idcliente'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->numeroTelefono = $args['numeroTelefono'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->activo = $args['activo'] ?? '';
    }

    //sets y gets

    function getId()
    {
        return $this->idcliente;
    }
    function setId($idcliente)
    {
        $this->idcliente = $idcliente;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function getApellido()
    {
        return $this->apellido;
    }
    function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    function getNumeroTelefono()
    {
        return $this->numeroTelefono;
    }

    function setNumeroTelefono($numeroTelefono)
    {
        $this->numeroTelefono = $numeroTelefono;
    }

    function getCorreo()
    {
        return $this->correo;
    }

    function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    function getActivo()
    {
        return $this->activo;
    }

    function setActivo($activo)
    {
        $this->activo = $activo;
    }
}
