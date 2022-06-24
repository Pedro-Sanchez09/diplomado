<?php
/*
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../../index.html");
}

echo "Hola " . $_SESSION['usuario'];

session_destroy();*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnComprar" type="button" class="btn btn-primary" data-toggle="modal">Realizar compra</button>
            </div>
        </div>
        <br>


        <h1>Productos en carrito</h1>
        <div class="row">

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaProductosC" class="table table-striped table-bordered table-condensed">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="total">
            <label for="base" class="col-form-label ">Base:</label>
            <input type="number" class="form-control" id="base" name="base" value="0" disabled>
            <label for="IVA" class="col-form-label ">IVA:</label>
            <input type="text" class="form-control" id="IVA" name="IVA" value="19%" disabled>
            <label for="total" class="col-form-label ">Total:</label>
            <input type="number" class="form-control" id="total" name="total"value="0" disabled>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./carrito.js"></script>
</body>

</html>