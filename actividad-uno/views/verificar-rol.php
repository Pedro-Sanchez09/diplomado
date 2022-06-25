
<?php

session_start();

if (isset($_SESSION['rol'])) {
    echo('rol:'.$_SESSION['rol']);
    switch ($_SESSION['rol']) {
        case 'CLIENTE':
            header("location: ./contenido/index-cliente.php");
            break;

        case 'VENDEDOR':
            header("location: ./producto/registrarCompra.php");
            break;

        case 'ADMIN':
            header("location: ./admin/");
            break;
    }
}else{
    header("location: ../"); 
}


?>

