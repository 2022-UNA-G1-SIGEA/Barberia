<?php

require '../../data/Conexion.php';

class Validaciones{

    private $errores = [];

    //metodo para validar espacios vacios
    public function validarCamposVacios($data){
        if(empty($data)){
            $this->errores[] = "El campo no puede estar vacio";
            
        }
    }

    //metodo para validar que el campo sea numerico
    public function validarCampoNumerico($data){
        if(!is_numeric($data)){
            $this->errores[] = "El campo debe ser numerico";
        }
    }

    //metodo para validar que el campo sea alfabetico
    public function validarCampoAlfabetico($data){
        if(!is_string($data)){
            $this->errores[] = "El campo debe ser alfabetico";
        }
    }

    //metodo para validar que el campo sea un correo
    public function validarCampoCorreo($data){
        //se valida y a la misma vez se sanitiza el campo
        if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
            $this->errores[] = "El campo debe ser un correo";
        }
    }


    //metodo para validar que el campo sea un telefono
    public function validarCampoTelefono($data){
        //se valida y a la misma vez se sanitiza el campo
        if(!filter_var($data, FILTER_VALIDATE_INT)){
            $this->errores[] = "El campo debe ser un telefono";
        }
    }

    //metodo para vaciar el array de errores
    public function vaciarErrores(){
        $this->errores = [];
    }

    

    //validar que un campo no este repetido en la base de datos

    public function validarCampoRepetido($data, $tabla, $campo){
        
        try{
            require '../../data/Conexion.php';
            $query = "SELECT * FROM $tabla WHERE $campo = '$data'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            if($row){
                $this->errores[] = "El campo ya existe";
            }
        }catch(\Throwable $th){
            var_dump($th);
        }
    }










}



?>



