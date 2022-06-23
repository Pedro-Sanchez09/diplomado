<?php

require_once("../models/Producto.php");
require_once("../models/Cliente.php");
require_once("../models/Compra.php");
require_once("../config-bd/conexion.php");
$conexion = Database::getInstance();
$producto = new Producto();
$compra = new Compra();
$cliente = new Cliente();
$respuesta;


switch ($_GET["op"]) {

    case 'getProducto':
        $id = $_POST['id'];

        $res = $producto->getProducto($id);

        echo json_encode($res);

        break;
    case 'setProductos';
        $cc = intval($_POST['cliente']);

        $buscarC = $cliente->getCliente($cc);

        if (sizeof($buscarC['DATA']) == 0) {
            $respuesta = json_encode('Usuario_NO');
        } else {

            $fecha = $_POST['fecha'];
            $datos = $_POST['productos'];
            $cantidad = 0;
            $idProducto = 0;
            $importe = 0;
            $respuesta = json_encode($compra->guardarCompra($fecha, $cc));
            $lastIdCompra = mysqli_insert_id($conexion->getConnection());

            for ($i = 0; $i < sizeof($datos); $i++) {

                $idProducto = intval($datos[$i][0]);
                $cantidad = intval($datos[$i][1]);
                $importe =  doubleval($datos[$i][2]);
                $compra->guardarDetalleCompra($lastIdCompra, $idProducto, $cantidad, $importe);
            }
        }

        echo $respuesta;



        break;


    default:
        # code...
        break;
}
