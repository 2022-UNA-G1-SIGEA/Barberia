<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Servicio</title>
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


        <div>
            <div>
                <label>Palabra a buscar</label>
                <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbservicio', 'tbserviciosnombre','tbserviciosdescripcion');" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

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
        <a href="Index.php" class="btn-submit">index</a>
        <table>
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require '../business/ServicioBusiness.php';
                require '../domain/Servicio.php';
                $servicioBusiness = new ServicioBusiness();
                $array = $servicioBusiness->getAllServicios();

                if (isset($_GET['update'])) {

                    $id = $_GET['update'];
                    $servicio = $servicioBusiness->getOneServicio($id);
                } else if (isset($_GET['delete'])) {

                    $idServicio = $_GET['delete'];
                    $servicioBusiness->deleteServicio($idServicio, 0);
                    header('Location: ListaServicios.php');
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $id = $_POST['idServicio'] ?? '';
                    $servicio = new Servicio($_POST);
                    if ($id == '') {
                        $servicioBusiness->insertServicio($servicio);
                        header("location: ListaServicios.php");
                    } else {
                        $servicioBusiness->updateServicio($servicio);
                        header("location: ListaServicios.php");
                    }
                }
                foreach ($array as $servicios) : ?>
                    <tr>
                        <!--iterar servicios -->
                        <td><?php echo $servicios['tbserviciosid'] ?></td>
                        <td><?php echo $servicios['tbserviciosnombre'] ?></td>
                        <td><?php echo $servicios['tbserviciosdescripcion'] ?></td>
                        <td><?php echo $servicios['tbserviciosactivo'] ?></td>
                        <td>
                            <form action="ListaServicios.php">
                                <button type="submit" name="update" value="<?php echo $servicios['tbserviciosid'] ?>">Editar</button>
                            </form>

                        </td>
                        <td>
                            <form action="ListaServicios.php">
                                <button type="submit" name="delete" value="<?php echo $servicios['tbserviciosid'] ?>" onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <form action="ListaServicios.php" method="POST" class="form" autocomplete="off">

        <div class="form-header">
            <h1 class="form-title">S<span>ervicio</span></h1>
        </div>

        <input id="tbserviciosid" type="hidden" name="idServicio" value="<?php if (!empty($servicio)) {
                                                                                echo $servicio['tbserviciosid'];
                                                                            } ?>">

        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" type="text" placeholder="Escriba el nombre" name="nombre" value="<?php if (!empty($servicio)) {
                                                                                                echo $servicio['tbserviciosnombre'];
                                                                                            } ?>">

        <label for="descripcion" class="form-label">Descripción</label>
        <input id="descripcion" type="text" placeholder="Escriba la descripcion" name="descripcion" value="<?php if (!empty($servicio)) {
                                                                                                                echo $servicio['tbserviciosdescripcion'];
                                                                                                            } ?>">

        <label for="activo" class="form-label">Estado</label>
        <select name="activo">
            <option disabled>seleccione</option>
            <option value="1">activo</option>
            <option value="0">noActivo</option>

            <input type="submit" class="btn-submit" value="Guardar información">
    </form>

</body>

</html>