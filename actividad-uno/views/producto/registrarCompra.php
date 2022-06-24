<?php

session_start();

 if ( !isset( $_SESSION['usuario'] ) ) {
    header("location: ../../index.html");
  } 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar compra</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>

    <div class="container">

        <div class="wrap-registro-producto">

            <form class="form validate-form" id="formRegistro" action="" method="post">

                <span class="form-title">Agregar producto</span>
                <span class='mostrar' id="mensajeU"></span>

                <div class="row">
                    <div class="col-lg-6">

                        <label for="cc" class="col-form-label">CC:</label>
                        <input type="number" class="form-control" id="cc" name="cc">



                       
                    </div>

                    <div class="col-lg-6">

                        <label for="referencia" class="col-form-label">Referencia:</label>
                        <input type="number" class="form-control" id="idProducto" name="idProducto" required>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <label for="descripcion" class="col-form-label">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" disabled>


                    </div>

                </div>



                <div class="row">
                    <div class="col-lg-6">

                        <label for="cantidad" class="col-form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>


                    </div>
                    <div class="col-lg-6">

                        <label for="precio" class="col-form-label ">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="precio" disabled>
                    </div>

                </div>

                <br>
                <div>
                    <button type="submit" class="btn btn-primary form-control" id="registrar" name="registrar">Agregar
                        al carrito</button>



                </div>


            </form>

           
            
        </div>
        <div class="agregar"> <button type="button" id="btncomprar" name="comprar">Comprar Productos</button></div>
        
        <div class="containerT">

            <br />
            <h2>Lista Productos</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">

                            <table id="tablaProductos" class="table table-striped table-bordered table-condensed">
                                <thead class="text-center">
                                    <tr>
                                        <th>Ref</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Importe</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./registrarProducto.js"></script>
</body>

</html>