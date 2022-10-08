<?php

class Silla
{
    // Atributos de la clase 
    private $idsilla;
    private $serie;
    private $marca;
    private $modelo;
    private $precioCompra;
    private $activo;

    //Constructor

    public function __construct($args = [])
    {
        $this->idsilla = $args['idsilla'] ?? '';
        $this->serie = $args['serie'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->modelo = $args['modelo'] ?? '';
        $this->precioCompra = $args['precioCompra'] ?? '';
        $this->activo = $args['activo'] ?? '';
    }

    //Sets y gets

    public function getIdsilla()
    {
        return $this->idsilla;
    }

    public function getSerie()
    {
        return $this->serie;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setIdsilla($idsilla)
    {
        $this->idsilla = $idsilla;
    }

    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }
}
