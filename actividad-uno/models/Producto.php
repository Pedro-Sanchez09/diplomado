
<?php
require_once("../config-bd/conexion.php");

class Producto
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
    }
    public function getProductos()
    {
        $sql = "SELECT `pro-id` as id, `descripcion`, `precio` FROM productos  ";
        $res = $this->conexion->get_data($sql);

        return $res;
    }
    public function getProducto($id)
    {
        $buscar = "SELECT * FROM productos where `pro-id`='$id' ";
        $res = $this->conexion->get_data($buscar);

        return $res;
    }
}
?>