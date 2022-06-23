<?php
require_once("../config-bd/conexion.php");
class Compra
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
    }

    public function guardarCompra($fecha, $cc)
    {
        $guardarCompra = "INSERT INTO compras (`com-id`, `com-fecha`, `cliente`) VALUES (NULL, '$fecha', $cc)";
        $res = $this->conexion->exec($guardarCompra);
        return $res;
    }

    public function guardarDetalleCompra($lastIdCompra,$idProducto,$cantidad,$importe)
    {
        $guardarDetalle_Compra = "INSERT INTO `detalle_compra` (`compra`,`producto`,`cantidad`,`importe`)VALUES($lastIdCompra,$idProducto,$cantidad,$importe)";
        $res=$this->conexion->exec($guardarDetalle_Compra);
        return $res;
    }
}
