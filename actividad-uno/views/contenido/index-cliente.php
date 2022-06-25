<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("location: ../../");
} else {
 

    if ($_SESSION['rol'] != 'CLIENTE') {
        switch ($_SESSION['rol']) {
            case "ADMIN":
                header("location: ../admin/");
                break;

            case "VENDEDOR":
                header("location: ../producto/registrarCompra.php");
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>

    <div class="container">

        <a href="./index-cliente.php">Inicio</a>
        <a id="salir" href="./salir.php">Salir</a>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <button id="btnVerCarrito" type="button" class="btn btn-primary" data-toggle="modal">Carrito productos</button>
            </div>
        </div>
        <br>


        <h1>Lista de productos</h1>
        <div class="row">

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaProductos" class="table table-striped table-bordered table-condensed">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Descripcion</th>
                                <th>Precio</th>

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <?php require_once('./modal-cantidad.php'); ?>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./index-cliente.js"></script>

</body>

</html>