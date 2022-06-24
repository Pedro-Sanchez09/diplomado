<!doctype html>
<html>

<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrar usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>

    <div class="container-mod">
        <div class="wrap-registro">

            <form class="login-form validate-form" id="formRegistro" method="post">

                <span class="form-title">REGISTRO</span>
                <span class='mostrar' id="mensaje"></span>

                <div class="row">
                    <div class="col-lg-6">

                        <label for="cc" class="col-form-label">CC:</label>
                        <input type="text" class="form-control" id="cc" name="cc" required>

                        <span class='mostrar' id="mensajeU"></span>
                    </div>

                    <div class="col-lg-6">

                        <label for="rol" class="col-form-label">Rol:</label>
                        <select name="rol" class="form-control" id="perfil" required>
                            <option value="">---Elije un perfil------</option>
                            <option value="ADMIN">Admin</option>
                            <option value="VENDEDOR">Vendedor</option>
                            <option value="CLIENTE">Cliente</option>

                        </select>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">

                        <label for="nombres" class="col-form-label">Nombres:</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" required>


                    </div>
                    <div class="col-lg-6">

                        <label for="direccion" class="col-form-label ">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">

                        <label for="usuario" class="col-form-label">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" require>

                        <span class='mostrar' id="mensajeE"></span>
                    </div>
                    <div class="col-lg-6">

                        <label for="celular" class="col-form-label ">Celular:</label>
                        <input type="text" class="form-control" id="celular" name="celular" required>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">

                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>


                    </div>
                    <div class="col-lg-6">

                        <label for="passwordV" class="col-form-label ">Verificar Password:</label>
                        <input type="password" class="form-control" id="passwordV" name="passwordV" required> 
                    </div>

                </div>
                <span class='mostrar' id="mensPass"></span>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary form-control" id="registrar" name="registrar">Registrar</button>


                    <button type="button" class="btn form-control" id="cancelar">Cancelar</button>
                </div>


            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./registrar.js"></script>
</body>

</html>