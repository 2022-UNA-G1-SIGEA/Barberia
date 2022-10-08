<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <a href="Index.php" class="btn-submit">Index</a>

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

<body>
    <div id="main-container">
        <table>

            <script type="text/javascript">
                function confirmarEliminar() {
                    var respuesta = confirm("¿Está seguro de eliminar el registro?");
                    if (respuesta == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>

            <div>
                <div>
                    <label>Palabra a buscar</label>
                    <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbcliente', 'tbclientenombre','tbclientetelefono');" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

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

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include '../business/ClienteBusiness.php';

                $clienteBusiness = new ClienteBusiness();

                $array = $clienteBusiness->getAllCliente();

                if (isset($_GET['update'])) {

                    $id = $_GET['update'];
                    $clienteUpdate = $clienteBusiness->getOneCliente($id);
                } else if (isset($_GET['delete'])) {

                    $idcliente = $_GET['delete'];
                    $clienteBusiness->deleteCliente($idcliente, 0);
                    header('Location: ListaCliente.php');
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $id = $_POST['idcliente'] ?? '';
                    
                    $cliente = new Cliente($_POST);
                    if ($id == '') {
                        $clienteBusiness->insertCliente($cliente);
                        header("location: ListaCliente.php");
                    } else {
                        $clienteBusiness->updateCliente($cliente);
                        header("location: ListaCliente.php");
                    }
                }

                foreach ($array as $cliente) : ?>
                    <tr>
                        <td><?php echo $cliente['tbclientenombre'] ?></td>
                        <td><?php echo $cliente['tbclienteapellido'] ?></td>
                        <td><?php echo $cliente['tbclientetelefono'] ?></td>
                        <td><?php echo $cliente['tbclientecorreo'] ?></td>
                        <td><?php echo $cliente['tbclienteactivo'] ?></td>
                        <td>
                            <form action="ListaCliente.php">
                                <button type="submit" name="update" value="<?php echo $cliente['tbclienteid'] ?>">Editar</button>
                            </form>

                        </td>
                        <td>
                            <form action="ListaCliente.php">
                                <button type="submit" name="delete" value="<?php echo $cliente['tbclienteid'] ?>" onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <form action="ListaCliente.php" method="POST" class="form" autocomplete="off">

        <div class="form-header">
            <h1 class="form-title">For<span>mulario</span></h1>
        </div>


        <input id="idcliente" type="hidden" class="form-input" name="idcliente" value="<?php if (!empty($clienteUpdate)) {
                                                                                            echo $cliente['tbclienteid'];
                                                                                        } ?>">

        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" type="text" class="form-input" placeholder="Escriba el nombre" name="nombre" value="<?php if (!empty($clienteUpdate)) {
                                                                                                                    echo $cliente['tbclientenombre'];
                                                                                                                } ?>">

        <label for="apellido" class="form-label">Apellido</label>
        <input id="apellido" type="text" class="form-input" placeholder="Escriba el apellido" name="apellido" value="<?php if (!empty($clienteUpdate)) {
                                                                                                                            echo $cliente['tbclienteapellido'];
                                                                                                                        } ?>">

        <label for="telefono" class="form-label">Telefono</label>
        <input id="telefono" type="number" class="form-input" placeholder="Escriba el telefono" name="numeroTelefono" value="<?php if (!empty($clienteUpdate)) {
                                                                                                                                    echo $cliente['tbclientetelefono'];
                                                                                                                                } ?>">


        <label for="correo" class="form-label">Correo</label>
        <input id="correo" type="email" class="form-input" placeholder="Escriba el correo" name="correo" value="<?php if (!empty($clienteUpdate)) {
                                                                                                                    echo $cliente['tbclientecorreo'];
                                                                                                                } ?>">

        <label for="activo" class="form-label">Estado</label>
        <select name="activo" id="activo">

            <option value="1">seleccione</option>
            <option value="1">activo</option>
            <option value="0">noActivo</option>
        </select>

        <input type="submit" class="btn-submit" value="Guardar información">
    </form>
</body>

</html>