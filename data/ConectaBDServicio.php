<?php


class ConectaBDServicio{

//metodo para traer todos los servicios
    public static function getAllServicios()
    {
        try {
            require 'Conexion.php';

            $query = "SELECT * FROM tbservicio WHERE tbserviciosactivo = 1";
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

    public static function getAllServiciosNoActivo()
    {
        try {
            require 'Conexion.php';

            $query = "SELECT * FROM tbservicio WHERE tbserviciosactivo = 0";
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

    public static function getOneServicio($idservicio)
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbservicio WHERE tbserviciosid = $idservicio";

            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            return $row;
        } catch (\Throwable $th) {
            var_dump($th);
        }

    }
    public static function insertServicio($servicio)
    {
        try {
            require 'Conexion.php';
            //obtener ultimo id
            $queryid = "SELECT MAX(tbserviciosid) AS idservicio FROM tbservicio";
            $idCont = mysqli_query($db, $queryid);
            $nextId = 0;

            if ($row = mysqli_fetch_row($idCont)) {

                if($row[0] == null){
                    $nextId = 1;
                }else{
                    $nextId = trim($row[0]) + 1;
                }
            }
        
            $servicio->setIdServicio($nextId);
            $query = "INSERT INTO tbservicio VALUES (" . $servicio->getIdServicio() . ",'" .
            $servicio->getNombre() . "','" . $servicio->getDescripcion() . "'," . $servicio->getActivo() . ")";
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }


    public static function updateServicio($servicio)
    {
        try {
            require 'Conexion.php';
            $query = "UPDATE tbservicio SET tbserviciosnombre = '" . $servicio->getNombre() . "', tbserviciosdescripcion = '" . $servicio->getDescripcion() . "', tbserviciosactivo = " . $servicio->getActivo() . " WHERE tbserviciosid = " . $servicio->getIdServicio();
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function deleteServicio($idservicio,$activo)
    {
        try {
            require 'Conexion.php';
            $query = "UPDATE tbservicio SET tbserviciosactivo = $activo WHERE tbserviciosid = $idservicio";
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }


 }
?>