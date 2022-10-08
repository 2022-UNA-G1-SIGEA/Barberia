<?php
    include '../domain/ClienteCategoria.php';

    class ConectaBDClienteCategoria
    {
        public function getAllClientCategory()
        {
            try {
                require 'Conexion.php';
    
                $query = "SELECT * FROM tbclientecategoria WHERE tbclientecategoriaactivo = 1";
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

        public function getAllClientCategoryNoActivo()
        {
            try {
                require 'Conexion.php';
    
                $query = "SELECT * FROM tbclientecategoria WHERE tbclientecategoriaactivo = 0";
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

        
    public function getOneClientCategory($idclientecategoria)
    {
        try {
            require 'Conexion.php';
            $query = "SELECT * FROM tbclientecategoria WHERE tbclientecategoriaid = $idclientecategoria";         
            $result = mysqli_query($db, $query);

            $row = mysqli_fetch_assoc($result);
            return $row;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public function insertClientCategory($ClienteCategoria)
    {       
        try {
            require 'Conexion.php';

            $query = "SELECT MAX(tbclientecategoriaid) AS idclientecategoria FROM tbclientecategoria";
            
            
            $idCont = mysqli_query($db, $query);
            $nextId = 0;

            if ($row = mysqli_fetch_row($idCont)) {
                if($row[0] == null){
                    $nextId = 1;
                }else{
                    $nextId = trim($row[0]) + 1;
                }

             
            }
          
            $ClienteCategoria->setIdclientecategoria($nextId);
            $queryInsert = "INSERT INTO tbclientecategoria VALUES ({$nextId},  '{$ClienteCategoria->getDescripcion()}', {$ClienteCategoria->getActivo()}, '{$ClienteCategoria->getNombre()}')";
            
            
            $result = mysqli_query($db, $queryInsert);


          
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public function updateClientCategory($ClienteCategoria)
    {
        try {
            require 'Conexion.php';
            $queryUpdate = "UPDATE tbclientecategoria SET " .
                "tbclientecategoriadescripcion = '" . $ClienteCategoria->getDescripcion() . "'," .
                "tbclientecategoriaactivo = '" . $ClienteCategoria->getActivo()  . "'," .
                "tbclientecategorianombre = '". $ClienteCategoria->getNombre() . "' WHERE tbclientecategoriaid = " . $ClienteCategoria->getIdclientecategoria();
                
                 


            $result = mysqli_query($db, $queryUpdate);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    public function deleteClientCategory($idclientecategoria, $activo)
    {
        try {
            require 'Conexion.php';
            $query = "UPDATE tbclientecategoria SET tbclientecategoriaactivo = $activo WHERE tbclientecategoriaid = $idclientecategoria";
            $result = mysqli_query($db, $query);
            mysqli_close($db);
            return $result;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }



}
?>