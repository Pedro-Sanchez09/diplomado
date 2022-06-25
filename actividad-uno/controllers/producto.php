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
        $id = intval($_GET['id']);
        $respuesta = $producto->getProducto($id);
        echo json_encode($respuesta);
        break;

    case 'getProductos':
        $respuesta = $producto->getProductos();
        echo json_encode($respuesta);
        break;
    case 'agregarCarrito':
        $carr = $_POST['carrito'];
        $respuesta = array('carrito' => $carr[0]);
        session_start();
        $_SESSION['carrito'] = $respuesta;

        echo json_encode($respuesta);

        break;

    case 'getCarrito':
        session_start();
        if (isset($_SESSION['carrito'])) {
            $respuesta = array('STATUS' => 'OK', 'DATA' => $_SESSION['carrito']);
        } else {
            $respuesta = array('STATUS' => 'ERROR');
        }
        echo json_encode($respuesta);

        break;

    case 'getProducto':
        $id = $_POST['id'];

        $respuesta = $producto->getProducto($id);

        echo json_encode($respuesta);

        break;

    case 'setProducto':
        $id = intval($_POST['id']);
        $precio = floatval($_POST['precio']);
        $descripcion = $_POST['descripcion'];
        $respuesta = $producto->setProducto($id, $descripcion, $precio);
        echo json_encode($respuesta);

        break;
    case 'setCompra';

        $cc = intval($_POST['cliente']);

        $buscarC = $cliente->getCliente($cc);

        if (sizeof($buscarC['DATA']) == 0) {
            $respuesta = array('STATUS' => 'ERROR', 'Mensage' => 'Cliente no existe en el sistema!');
        } else {

            $fecha = $_POST['fecha'];
            $datos = $_POST['productos'];
            $respuesta = $datos;
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
        }

        echo json_encode($respuesta);



        break;

    case 'update':
        $id = intval($_POST['id']);
        $precio = floatval($_POST['precio']);
        $descripcion = $_POST['descripcion'];
        $respuesta = $producto->updateProducto($id, $descripcion, $precio);
        echo json_encode($respuesta);
        break;

    case 'eliminar':
        $id = intval($_POST['id']);
        $respuesta = $producto->deleteProducto($id);
        echo json_encode($respuesta);
        break;


    default:
        # code...
        break;
}
