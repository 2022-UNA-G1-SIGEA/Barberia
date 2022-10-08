<?php

class ClienteTipo
{

    private $id;
    private $clienteTipoPeriodicidad;
    private $clienteTipoCancelacion;
    private $clientetipoingresomensual;
    private $clienteTipoPuntaje;
    public $clienteTipoActivo;

    //constructor
    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? '';
        $this->clienteTipoPeriodicidad = $args['clienteTipoPeriodicidad'] ?? '';
        $this->clienteTipoCancelacion = $args['clienteTipoCancelacion'] ?? '';
        $this->clientetipoingresomensual = $args['clientetipoingresomensual'] ?? '';
        $this->clienteTipoPuntaje = $args ['clienteTipoPuntaje'] ?? '';
        $this->clienteTipoActivo = $args ['clienteTipoActivo'] ?? '';
    }


    //Getters
    public function getId()
    {
        return $this->id;
    }

    public function getClienteTipoPeriodicidad()
    {
        return $this->clienteTipoPeriodicidad;
    }

    public function getClienteTipoCancelacion()
    {
        return $this->clienteTipoCancelacion;
    }

    public function getClienteTipoIngresoMensual()
    {
        return $this->clientetipoingresomensual;
    }   

    public function getClienteTipoPuntaje()
    {
        return $this->clienteTipoPuntaje;
    }

    public function getClienteTipoActivo()
    {
        return $this->clienteTipoActivo;
    }

    //Setters

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setClienteTipoPeriodicidad($clienteTipoPeriodicidad)
    {
        $this->clienteTipoPeriodicidad = $clienteTipoPeriodicidad;
    }   

    public function setClienteTipoCancelacion($clienteTipoCancelacion)
    {
        $this->clienteTipoCancelacion = $clienteTipoCancelacion;
    }

    public function setClienteTipoIngresoMensual($clientetipoingresomensual)
    {
        $this->clientetipoingresomensual = $clientetipoingresomensual;
    }   

    public function setClienteTipoPuntaje($clienteTipoPuntaje)
    {
        $this->clienteTipoPuntaje = $clienteTipoPuntaje;
    }   

    public function setClienteTipoActivo($clienteTipoActivo)
    {
        $this->clienteTipoActivo = $clienteTipoActivo;
    }   


}
