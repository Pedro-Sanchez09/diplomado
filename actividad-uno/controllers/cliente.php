<?php

require_once("../models/Compra.php");
require_once("../config-bd/conexion.php");
$conexion = Database::getInstance();
$compra = new Compra();

$respuesta;


switch ($_GET["op"]) {


    case 'comprar';
        session_start();
        $cc = intval($_SESSION['usuario_id']);

        $fecha = $_POST['fecha'];
        $datos = $_POST['productos'];
        $cantidad = 0;
        $idProducto = 0;
        $importe = 0;
        $respuesta = $compra->guardarCompra($fecha, $cc);
        $lastIdCompra = mysqli_insert_id($conexion->getConnection());

        for ($i = 0; $i < sizeof($datos); $i++) {

            $idProducto = intval($datos[$i][0]);
            $cantidad = intval($datos[$i][1]);
            $importe =  doubleval($datos[$i][2]);
            $compra->guardarDetalleCompra($lastIdCompra, $idProducto, $cantidad, $importe);
        }

        unset($_SESSION['carrito']);

        echo json_encode($respuesta);



        break;


    default:
        # code...
        break;
}
