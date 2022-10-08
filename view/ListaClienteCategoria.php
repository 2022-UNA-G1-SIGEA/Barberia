<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categoría Cliente</title>
    
</head>

<script type="text/javascript">
    function confirmarEliminacion() {
        var respuesta = confirm("¿Está seguro de eliminar el registro?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script type="text/javascript">
    function confirmarEdicion() {
        var respuesta = confirm("¿Está seguro que desea editar?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<body class="body-list">
    <h1>Lista de categorías de clientes</h1>
    <a href="Index.php" class="btn-submit">Index</a>
    <div id="main-container">

    <div>
            <div>
                <label>Palabra a buscar</label>
                <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbclientecategoria', 'tbclientecategorianombre','tbclientecategoriadescripcion');" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

            </div>
            <div id="datos_buscador"></div>
        </div>

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function buscar_ahora(dato, tb, col1, col2) {

                $.ajax({
                    data: 'buscar=' + dato + "&tabla=" + tb + "&column1=" + col1 + "&column2=" + col2,
                    type: "POST",
                    url: "../business/Buscador.php",
                    success: function(data) {

                        $("#datos_buscador").empty().append(data);
                        // document.getElementById("datos_buscador").innerHTML = data;
                    }
                });
            }
        </script><br></br>


        <table>

            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Descripción</th>
                    <th>Activo</th>
                    <th>Nombre de la categoría</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
                <?php

                require '../business/ClienteCategoriaBusiness.php';

                $clienteCategoriaBusiness = new ClienteCategoriaBusiness();
                $array = $clienteCategoriaBusiness->getAllClientCategory();



                if (isset($_GET['update'])) {

                    $id = $_GET['update'];
                    
                    $clientecategoria = $clienteCategoriaBusiness->getOneClientCategory($id);
                    
                    
                }else if(isset($_GET['delete'])){

                    $idClienteCategoria = $_GET['delete'];
                    $clienteCategoriaBusiness->deleteClientCategory($idClienteCategoria,0);
                    header('Location: ListaClienteCategoria.php');
                }

                if($_SERVER["REQUEST_METHOD"] == "POST"){

                    $id = $_POST['idclientecategoria'] ?? '';
                    $ClienteCategoria = new ClienteCategoria($_POST);

                    if($id == ''){
                        $clienteCategoriaBusiness->insertClientCategory($ClienteCategoria);
                        header('Location: ListaClienteCategoria.php');
                    }else{
                        $clienteCategoriaBusiness->updateClientCategory($ClienteCategoria);
                        header('Location: ListaClienteCategoria.php');
                    }
                    
                }

                foreach ($array as $clienteCategoria) : ?>
                    <tr>
                        <td><?php echo $clienteCategoria['tbclientecategoriaid'] ?></td>
                        <td><?php echo $clienteCategoria['tbclientecategoriadescripcion'] ?></td>
                        <td><?php echo $clienteCategoria['tbclientecategoriaactivo'] ?></td>
                        <td><?php echo $clienteCategoria['tbclientecategorianombre'] ?></td>

                        <td>
                            <form action="ListaClienteCategoria.php"> 

                                <button type="submit" name="update" value="<?php echo $clienteCategoria["tbclientecategoriaid"]  ?>" onclick="return confirmarEdicion()">Editar</button>
                            </form>
                        </td>

                        <td>
                            <form>
                                <button type="submit" name="delete" value="<?php echo $clienteCategoria["tbclientecategoriaid"] ?>" onclick="return confirmarEliminacion()" >Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>
    <form action="ListaClienteCategoria.php" method="POST" autocomplete = "off">
        <br></br>
        <input id="id" type="hidden" name = "idclientecategoria" value="<?php if (!empty($clientecategoria)){
                                                                              echo $clientecategoria['tbclientecategoriaid'];
                                                                              }?>">

                                                                                            
        <label for="nombre"> Nombre </label>
        <input id="nombre" type="text" placeholder= "nombre" name="nombre" value="<?php if (!empty($clientecategoria)){
                                                                                                 echo $clientecategoria['tbclientecategorianombre'];
                                                                                        }?>">
         
        


        <label for="descripcion"> Descripción </label>
        <input id="descripcion" type="text" placeholder= "descripcion" name="descripcion" value="<?php if (!empty($clientecategoria)){
                                                                                                          echo $clientecategoria['tbclientecategoriadescripcion'];
                                                                                                        }?>"> <br></br>

        <div class="form-radio">
        <label for="activo"> Activo </label>    
        <select name="activo" id="activo">  
        <option value="1">seleccione</option> 
        <option value="1">activo</option> 
        <option value="0">noActivo</option>  
        </div>                                                                                       
                                                                                 
        <input type="submit" value="Guardar">                                                                                    
                                                              
    </form>    
</body>

</html>