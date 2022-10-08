<?php

include '../domain/Silla.php';

class ConectaBDSilla
{

    public function __construct()
    {
    }

    public static function getAllChair()
    {
      
        try {
            require 'Conexion.php';

            $query = "SELECT * FROM tbsilla WHERE tbsillaactivo = 1";
            $result = mysqli_query($db, $query);


            $array = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }

            return $array;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function getAllChairNoActivo()
    {
        try {
            require 'Conexion.php';

            $query = "SELECT * FROM tbsilla WHERE tbsillaactivo = 0";
            $result = mysqli_query($db, $query);

            $array = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }

            return $array;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function getOneChair($idsilla)
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbsilla WHERE idtbsilla = $idsilla";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            return $row;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function insertChair($silla)
    {
        try {
            require 'Conexion.php';
            //obtener ultimo id
            $query = "SELECT MAX(idtbsilla) AS idsilla FROM tbsilla";
            $idCont = mysqli_query($db, $query);
            $nextId = 0;

            if ($row = mysqli_fetch_row($idCont)) {

                if($row[0] == null){
                    $nextId = 1;
                }else{
                    $nextId = trim($row[0]) + 1;
                }
               
             
            }
            $silla->setIdsilla($nextId);
            $queryInsert = "INSERT INTO tbsilla VALUES (" . $silla->getIdsilla() . ",'" .
                $silla->getSerie() . "','" . $silla->getMarca() . "','" . $silla->getModelo() . "'," .
                $silla->getPrecioCompra() . "," . $silla->getActivo() . ")";

            $result = mysqli_query($db, $queryInsert);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }
    public static function deleteChair($idsilla, $activo)
    {
        try {
            require 'Conexion.php';
            $query = "UPDATE tbsilla SET tbsillaactivo = $activo WHERE idtbsilla = $idsilla";
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }





    public static function updateChair($silla)
    {
        try {
            require 'Conexion.php';
            $queryUpdate = "UPDATE tbsilla SET " .
                "tbsillaserie = '" . $silla->getSerie() . "'," .
                "tbsillamarca = '" . $silla->getMarca() . "'," .
                "tbsillamodelo = '" . $silla->getModelo() . "'," .
                "tbsillapreciocompra = " . $silla->getPrecioCompra() . "," .
                "tbsillaactivo = " . $silla->getActivo() . " WHERE idtbsilla = " . $silla->getIdsilla();
            
            $result = mysqli_query($db, $queryUpdate);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public  function debuguear($variable)
    {
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit();
    }
}
