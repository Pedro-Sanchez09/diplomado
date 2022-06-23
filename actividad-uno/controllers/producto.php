<?php

require_once("../config-bd/conexion.php");
$conexion = Database::getInstance();


switch ($_GET["op"]) {

    case 'getProducto':
        $id = $_POST['id'];
        $buscar = "SELECT * FROM productos where `pro-id`='$id' ";
        $res = $conexion->get_data($buscar);


        echo json_encode($res);

        break;
    case 'setProductos';
        $cc = intval($_POST['cliente']);

        $buscarC = "SELECT * FROM clientes where cedula='$cc'";
        $resB = $conexion->get_data($buscarC);

        if ($resB == 0) {
            $crearUs = "INSERT INTO clientes(cedula) VALUES($cc)";
            $res = $conexion->exec($crearUs);
        }

        $fecha = $_POST['fecha'];
        $datos = $_POST['productos'];
        $cantidad=0;
        $idProducto = 0;
        $importe = 0;
       
        $guardarCompra ="INSERT INTO compras (`com-id`, `com-fecha`, `cliente`) VALUES (NULL, '$fecha', $cc)";
        $conexion->exec($guardarCompra);
        $lastIdCompra=mysqli_insert_id($conexion->getConnection());
        for ($i = 0; $i < sizeof($datos); $i++) {

        $idProducto = intval($datos[$i][0]);
        $cantidad=intval($datos[$i][1]);
        $importe =  doubleval($datos[$i][2]);
        $guardarDetalle_Compra="INSERT INTO `detalle_compra` (`compra`,`producto`,`cantidad`,`importe`)VALUES($lastIdCompra,$idProducto,$cantidad,$importe)";
        $conexion->exec($guardarDetalle_Compra);
        }


        echo json_encode('OK');



        break;
 

    default:
        # code...
        break;
}
