<?php

class Tarifa
{
    private $idtarifa;
    private $fechamodificada;
    private $monto;
    private $activo;


    function __construct($args = [])
    {
        $this->idtarifa = $args['idtarifa'] ?? '';
        $this->fechamodificada = $args['fechamodificada'] ?? '';
        $this->monto = $args['monto'] ?? '';
        $this->activo = $args['activo'] ?? '';
    }


    function getIdTarifa()
    {
        return $this->idtarifa;
    }
    function setIdTarifa($idtarifa)
    {
        $this->idtarifa = $idtarifa;
    }
    function getFechaModificada()
    {
        return $this->fechamodificada;
    }
    function setFechaModificada($fechamodificada)
    {
        $this->fechamodificada = $fechamodificada;
    }
    function getMonto()
    {
        return $this->monto;
    }
    function setMonto($monto)
    {
        $this->monto = $monto;
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
