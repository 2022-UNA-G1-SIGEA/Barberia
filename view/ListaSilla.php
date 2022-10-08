<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Silla</title>
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
                <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbsilla', 'tbsillamarca','tbsillaserie');" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

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
                    <th>Serie</th>
                    <th>Marca</th>
                    <th>modelo</th>
                    <th>Precio de compra</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                <a href="Index.php" class="btn-submit">index</a>
            </thead>
            <tbody>
                <?php

                require '../business/SillaBusiness.php';
                $SillaBusiness  = new SillaBusiness();
                $array = $SillaBusiness->getAllChair();

                    if (isset($_GET['update'])) {
                        $id = $_GET['update'];
                        $silla = $SillaBusiness->getOneChair($id);
                    } else if (isset($_GET['delete'])) {
                        $idsilla = $_GET['delete'];
                        $SillaBusiness->deleteChair($idsilla, 0);
                        header('Location: ListaSilla.php');
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $id = $_POST['idsilla'] ?? '';
                        $silla = new Silla($_POST);
                        if ($id == '') {

                            $SillaBusiness->insertChair($silla);
                            header('Location: ListaSilla.php');
                        } else {
                            $SillaBusiness->updateChair($silla);
                            header('Location: ListaSilla.php');
                        }
                    }

                    foreach ($array as $chair) : ?>
                        <tr>
                            <td><?php echo $chair['idtbsilla'] ?></td>
                            <td><?php echo $chair['tbsillaserie'] ?></td>
                            <td><?php echo $chair['tbsillamarca'] ?></td>
                            <td><?php echo $chair['tbsillamodelo'] ?></td>
                            <td><?php echo $chair['tbsillapreciocompra'] ?></td>
                            <td><?php echo $chair['tbsillaactivo'] ?></td>
                            <td>
                                <form action="ListaSilla.php">
                                    <button type="submit" name="update" value="<?php echo $chair['idtbsilla'] ?>">Editar</button>
                                </form>

                            </td>
                            <td>
                                <form action="ListaSilla.php">
                                    <button type="submit" name="delete" value="<?php echo $chair['idtbsilla'] ?> " onclick="return confirmarEliminacion()">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                
            </tbody>
        </table>
    </div>

    <!-- form de silla con atributos  serie, marca,modelo   precio compra, activo.  -->
    <form action="ListaSilla.php" method="POST" class="form" autocomplete="off">

        <div class="form-header">
            <h1 class="form-title">For<span>mulario</span></h1>
        </div>

        <input id="id" type="hidden" class="form-input" placeholder="Escriba la serie" name="idsilla" value="<?php if (!empty($silla)) {
                                                                                                                    echo $silla['idtbsilla'];
                                                                                                                }  ?>" />

        <label for="serie" class="form-label">Serie</label>
        <input id="serie" type="text" class="form-input" placeholder="Escriba la serie" name="serie" value="<?php if (!empty($silla)) {
                                                                                                                echo $silla['tbsillaserie'];
                                                                                                            }  ?>" />

        <label for="marca" class="form-label">Marca</label>
        <input id="marca" type="text" class="form-input" placeholder="Escriba la marca" name="marca" value="<?php if (!empty($silla)) {
                                                                                                                echo $silla['tbsillamarca'];
                                                                                                            } ?>" />

        <label for="modelo" class="form-label">Modelo</label>
        <input id="modelo" type="text" class="form-input" placeholder="Escriba el modelo" name="modelo" value="<?php if (!empty($silla)) {
                                                                                                                    echo $silla['tbsillamodelo'];
                                                                                                                } ?>" />

        <label for="compra" class="form-label">Precio Compra</label>
        <input id="compra" type="text" class="form-input" placeholder="Escriba el precio de compra" name="precioCompra" value="<?php if (!empty($silla)) {
                                                                                                                                    echo $silla['tbsillapreciocompra'];
                                                                                                                                } ?>" />

        <label for="activo" class="form-label">Activo</label>
        <select name="activo" id="activo">

            <option value="1">seleccione</option>
            <option value="1">activo</option>
            <option value="0">noActivo</option> echo "checked";
        </select>

        <input type="submit" class="btn-submit" value="Guardar información">

    </form>
</body>

</html>