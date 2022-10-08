<?php 
include '../domain/ClienteTipo.php';


class ConectaBDClienteTipo
{


    public  function getAllClienteTipo()
    {

        try{
            require 'Conexion.php';

            $query = "SELECT * FROM tbclientetipo WHERE tbclientetipoactivo = 1";
            $result = mysqli_query($db,$query);

            $array = [];

            while($row = mysqli_fetch_assoc($result)){
                $array[] = $row;
            }
            
            return $array;

        }catch(\Throwable $th){
            var_dump($th);
        }
    }

    public  function getOneClienteTipo($id)
    {
        try{
            require 'Conexion.php';
            $query = "SELECT * FROM tbclientetipo WHERE tbclientetipoid = $id";
            $result = mysqli_query($db,$query);

      
            $row = mysqli_fetch_assoc($result);
            return $row;
        }catch(\Throwable $th){
            var_dump($th);
        }

    }

    public  function insertClienteTipo($ClienteTipo)
    {
        
        try {
            require 'Conexion.php';
            $query = "SELECT MAX(tbclientetipoid) AS id FROM tbclientetipo";
            $idCont = mysqli_query($db, $query);
            $nextId = 0;

            if ($row = mysqli_fetch_row($idCont)) {
                if($row[0] == null){
                    $nextId = 1;
                }else{
                    $nextId = trim($row[0]) + 1;
                }
            }  
            $ClienteTipo->setId($nextId);
            $queryInsert = "INSERT INTO tbclientetipo VALUES (" . $ClienteTipo->getId() . "," . $ClienteTipo->getClienteTipoPeriodicidad() . "," . $ClienteTipo->getClienteTipoCancelacion() . "," . $ClienteTipo->getClienteTipoIngresoMensual(). "," . $ClienteTipo->getClienteTipoPuntaje()  . "," . $ClienteTipo->getClienteTipoActivo() . ")";
           
          
            $result = mysqli_query($db, $queryInsert);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }
 
   
    public  function deleteClienteTipo($id, $activo)
    {
     
        try {
            require 'Conexion.php';
            $query = "UPDATE tbclientetipo SET tbclientetipoactivo = $activo WHERE tbclientetipoid = $id";
         
            $result = mysqli_query($db, $query);     
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

 

    public  function updateClienteTipo($ClienteTipo)
    {
        
        try {
            require 'Conexion.php';
            $queryUpdate = "UPDATE tbclientetipo SET " .
                "tbclientetipoperiodicidad = " . $ClienteTipo->getClienteTipoPeriodicidad() . "," .
                "tbclientetipocancelacion = " . $ClienteTipo->getClienteTipoCancelacion()  . "," 
                . "tbclientetipoingresomensual=". $ClienteTipo->getClientetipoingresomensual() ."," 
                . "tbclientetipopuntaje=". $ClienteTipo->getClienteTipoPuntaje()."," 
                . "tbclientetipoactivo=". $ClienteTipo->getClienteTipoActivo() 
                ." WHERE tbclientetipoid = " . $ClienteTipo->getId();
                $result = mysqli_query($db, $queryUpdate);
            
                mysqli_close($db);
                return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }


}

?>