<?php
include '../domain/Tarifa.php';
Class ConectaBDTarifa{


    public static function getAllTarifa()
    {
        try {
            require 'Conexion.php';

            $query = "SELECT * FROM tbserviciotarifa WHERE tbserviciotarifaactivo = 1";
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


    public static function getOneTarifa($idtarifa)
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbserviciotarifa WHERE tbserviciotarifaid = $idtarifa";

            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            return $row;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function insertTarifa($tarifa)
    {
        try {
            require 'Conexion.php';
            //obtener ultimo id
            $query = "SELECT MAX(tbserviciotarifaid) AS idtarifa FROM tbserviciotarifa";
            $idCont = mysqli_query($db, $query);
            $nextId = 0;

            if ($row = mysqli_fetch_row($idCont)) {
                if($row[0] == null){
                    $nextId = 1;
                }else{
                    $nextId = trim($row[0]) + 1;
                }     
            }
            $tarifa->setIdTarifa($nextId);
            $queryInsert = "INSERT INTO tbserviciotarifa VALUES (" . $tarifa->getIdTarifa() . ",'" .
            $tarifa->getFechaModificada() . "','" . $tarifa->getMonto()."',". $tarifa->getActivo() . ")";
    
            $result = mysqli_query($db, $queryInsert);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function deleteTarifa($idtarifa,$activo)
    {
        try {
            require 'Conexion.php';
            $query = "UPDATE tbserviciotarifa SET tbserviciotarifaactivo = $activo WHERE tbserviciotarifaid = $idtarifa";
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }


    public static function updateTarifa($tarifa)
    {
        try {
            require 'Conexion.php';
            $queryUpdate = "UPDATE tbserviciotarifa SET " .
                "tbserviciotarifafechaactualizada = '" . $tarifa->getFechaModificada() . "'," .
                "tbserviciotarifamonto = '" . $tarifa->getMonto()  . "'," .
                "tbserviciotarifaactivo = ". $tarifa->getActivo() . " WHERE tbserviciotarifaid = " . $tarifa->getIdTarifa();
              
            $result = mysqli_query($db, $queryUpdate);
            
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

}
