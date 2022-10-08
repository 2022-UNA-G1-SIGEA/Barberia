<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tarifa</title>
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
                <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbserviciotarifa', 'tbserviciotarifafechaactualizada','tbserviciotarifamonto');" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

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
                    <th>Fecha de modificacion</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
                <?php

                require '../business/TarifaBusiness.php';
                $tarifabussines = new TarifaBusiness();
                $array = $tarifabussines->getAllTarifa();


                if (isset($_GET['update'])) {
                    $id = $_GET['update'];
                    $tarifa1 = $tarifabussines->getTarifa($id);
                } else if (isset($_GET['delete'])) {
                    $idtarifa = $_GET['delete'];
                    $tarifabussines->deleteTarifa($idtarifa, 0);
                    header('Location: Listatarifa.php');
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $id = $_POST['idtarifa'] ?? '';
                    $tarifa = new Tarifa($_POST);
                    if ($id == '') {

                        $tarifabussines->insertTarifa($tarifa);
                        header('Location: ListaTarifa.php');
                    } else {
                        $tarifabussines->updateTarifa($tarifa);
                        header('Location: ListaTarifa.php');
                    }
                }
                foreach ($array as $tarifa) : ?>
                    <tr>
                        <td><?php echo $tarifa['tbserviciotarifaid'] ?></td>
                        <td><?php echo $tarifa['tbserviciotarifafechaactualizada'] ?></td>
                        <td><?php echo $tarifa['tbserviciotarifamonto'] ?></td>
                        <td><?php echo $tarifa['tbserviciotarifaactivo'] ?></td>
                        <td>
                            <form action="ListaTarifa.php">
                                <button type="submit" name="update" value="<?php echo $tarifa['tbserviciotarifaid'] ?>">Editar</button>
                            </form>

                        </td>
                        <td>
                            <form action="ListaTarifa.php">
                                <button type="submit" name="delete" value="<?php echo $tarifa['tbserviciotarifaid'] ?>" onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>


                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


    <form action="ListaTarifa.php" method="POST" class="form" autocomplete="off">

        <div class="form-header">
            <h1 class="form-title"><span>Actualización de Tarifa</span></h1>
        </div>

        <input id="idtarifa" type="hidden" class="form-input" name="idtarifa" value="<?php if (!empty($tarifa1)) {
                                                                                            echo $tarifa1['tbserviciotarifaid'];
                                                                                        } ?>">

        <label for="fechamodificada" class="form-label">Fecha de Modificacion</label>
        <input id="fechamodificada" type="date" class="form-input" placeholder="Seleccione la Fecha de modificacion" name="fechamodificada" value="<?php if (!empty($tarifa)) {
                                                                                                                                                        echo $tarifa1['tbserviciotarifafechaactualizada'];
                                                                                                                                                    } ?>">

        <label for="monto" class="form-label">Monto</label>
        <input id="monto" type="text" class="form-input" placeholder="Escriba el monto nuevo" name="monto" value="<?php if (!empty($tarifa1)) {
                                                                                                                        echo $tarifa1['tbserviciotarifamonto'];
                                                                                                                    } ?>">

        <select name="activo" id="activo">

            <option value="1">seleccione</option>
            <option value="1">activo</option>
            <option value="0">noActivo</option>
        </select>

        <input type="submit" class="btn-submit" value="Guardar información">
    </form>
</body>

</html>