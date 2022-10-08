<?php
include '../domain/Cliente.php';

    class ConectaBDCliente{

    public static function getAllCliente()
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbcliente WHERE tbclienteactivo = 1";
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


    public static function getAllClienteNoActivo()
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbcliente WHERE tbclienteactivo = 0";
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


    public static function getOneCliente($idcliente)
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbcliente WHERE tbclienteid = $idcliente";

            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            return $row;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public function insertCliente($cliente )
    {
            //obtener el id del cliente de base de datos
            
            try {
                require 'Conexion.php';
                $query = "SELECT MAX(tbclienteid) AS id FROM tbcliente";
                $result = mysqli_query($db, $query);
                $nextId = 0;

                if ($row = mysqli_fetch_row($result)) {

                    if($row[0] == null){
                        $nextId = 1;
                    }else{
                        $nextId = trim($row[0]) + 1;
                    }
                   
                 
                }
               
            } catch (\Throwable $th) {
                var_dump($th);
            }

        try {
            require 'Conexion.php';
            $query = "INSERT INTO tbcliente (tbclienteid, tbclientenombre, tbclienteapellido, tbclientecorreo, tbclientetelefono, tbclienteactivo)
             VALUES ('$nextId','$cliente->nombre', '$cliente->apellido','$cliente->correo', '$cliente->numeroTelefono', $cliente->activo)";
            
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
            
            
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function updateCliente($cliente){
        try {
            require 'Conexion.php';
     // query para actualizar con atributos  nombre, apellido, , telefono, correo, activo  
            $query = "UPDATE tbcliente SET tbclientenombre = '$cliente->nombre', tbclienteapellido = '$cliente->apellido', tbclientetelefono = '$cliente->numeroTelefono', tbclientecorreo = '$cliente->correo', tbclienteactivo = $cliente->activo WHERE tbclienteid = $cliente->idcliente";

            $result = mysqli_query($db, $query);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public static function deleteCliente($idcliente){

        
        try {
            require 'Conexion.php';
            $query = "UPDATE tbcliente SET tbclienteactivo = 0 WHERE tbclienteid = $idcliente";
            $result = mysqli_query($db, $query);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    } 

    public static function activarCliente($idcliente){
        try {
            require 'Conexion.php';
            $query = "UPDATE tbcliente SET tbclienteactivo = 1 WHERE tbclienteid = $idcliente";
            $result = mysqli_query($db, $query);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    } 



}
