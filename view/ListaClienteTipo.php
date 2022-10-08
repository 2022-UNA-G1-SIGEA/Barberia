<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cliente Tipo</title>
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

<body class="body-list">
    <div id="main-container">

    <a href="Index.php" class="btn-submit">index</a>

    
    <div>
            <div>
                <label>Palabra a buscar</label>
                <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbclientetipo', 'tbclientetipopuntaje','tbclientetipoperiodicidad');" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

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
        </script>

        <table>
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Periodicidad</th>
                    <th>Cancelación</th>
                    <th>Ganancia</th>
                    <th>Puntaje</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
                <?php

                require '../business/ClienteTipoBusiness.php';
                $clienteTipoBusiness = new ClienteTipoBusiness();
                $array = $clienteTipoBusiness->getAllClienteTipo();

                if (isset($_GET['update'])) {

                    $id = $_GET['update'];
                    $clientetipo = $clienteTipoBusiness->getOneClienteTipo($id);
                } else if (isset($_GET['delete'])) {

                    $idClienteTipo = $_GET['delete'];
                    $clienteTipoBusiness->deleteClienteTipo($idClienteTipo, 0);
                    header('Location: ListaClienteTipo.php');
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $id = $_POST['id'] ?? '';

                    $ClienteTipo = new ClienteTipo($_POST);
                  
                    if ($id == '') {
                        
                        $clienteTipoBusiness->insertClienteTipo($ClienteTipo);
                        header('Location: ListaClienteTipo.php');
                        
                    } else {
                        $clienteTipoBusiness->updateClienteTipo($ClienteTipo);
                        header("location: ListaClienteTipo.php");
                    }
                }

                foreach ($array as $clienteTipo) : ?>
                    <tr>
                        <td><?php echo $clienteTipo['tbclientetipoid'] ?></td>
                        <td><?php echo $clienteTipo['tbclientetipoperiodicidad'] ?></td>
                        <td><?php echo $clienteTipo['tbclientetipocancelacion'] ?></td>
                        <td><?php echo $clienteTipo['tbclientetipoingresomensual'] ?></td>
                        <td><?php echo $clienteTipo['tbclientetipopuntaje'] ?></td>
                        <td><?php echo $clienteTipo['tbclientetipoactivo'] ?></td>
                        <td>
                            <form action="ListaClienteTipo.php">
                                <button type="submit" name="update" value="<?php echo $clienteTipo['tbclientetipoid'] ?>">Editar</button>
                            </form>

                        </td>
                        <td>
                            <form action="ListaClienteTipo.php">
                                <button type="submit" name="delete" value="<?php echo $clienteTipo['tbclientetipoid'] ?> " onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


    <form action="ListaClienteTipo.php" method="POST" autocomplete="off">

        <input id="id" type="hidden" name="id" value="<?php if (!empty($clientetipo)) {
                                                                        echo $clientetipo['tbclientetipoid'];
                                                                    } ?>">

        <label for="clientTipoPerioridad"> Periodicidad </label>
        <input id="clientTipoPerioridad" type="number" placeholder="Periodicidad" name="clienteTipoPeriodicidad" value="<?php if (!empty($clientetipo)) {
                                                                                                                            echo $clientetipo['tbclientetipoperiodicidad'];
                                                                                                                        } ?>">

        <label for="clienteTipoCancelacion"> Cancelación </label>
        <input id="clienteTipoCancelacion" type="number" placeholder="Cancelación" name="clienteTipoCancelacion" value="<?php if (!empty($clientetipo)) {
                                                                                                                            echo $clientetipo['tbclientetipocancelacion'];
                                                                                                                        } ?>">

        <label for="clienteTipoGanancia"> Ganancia </label>
        <input id="clienteTipoGanancia" type="number" placeholder="Ganancia" name="clientetipoingresomensual" value="<?php if (!empty($clientetipo)) {
                                                                                                                            echo $clientetipo['tbclientetipoingresomensual'];
                                                                                                                        } ?>">

        <label for="clienteTipoGanancia"> Puntaje </label>
        <input id="clienteTipoGanancia" type="text" placeholder="Puntaje" name="clienteTipoPuntaje" value="<?php if (!empty($clientetipo)) {
                                                                                                                echo $clientetipo['tbclientetipopuntaje'];
                                                                                                            } ?>">

        <div class="form-radio">
            <select name="clienteTipoActivo" id="clientetipoactivo">
                <option value="1">seleccione</option>
                <option value="1">activo</option>
                <option value="0">noActivo</option>

                <input type="submit" value="Guardar"><br></br>

    </form>

</body>

</html>