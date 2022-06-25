
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
        $buscar = "SELECT `pro-id` as id, `descripcion`, `precio`  FROM productos where `pro-id`='$id' ";
        $res = $this->conexion->get_data($buscar);

        return $res;
    }
    public function deleteProducto($id)
    {
        $sql = "DELETE FROM productos where `pro-id`='$id' ";
        $res = $this->conexion->exec($sql);
        return $res;
    }

    public function updateProducto($id, $descrip, $precio)
    {
        $sql = "UPDATE productos SET descripcion='$descrip', precio='$precio' where `pro-id`='$id'";
        $res = $this->conexion->exec($sql);
        return $res;
    }

    public function setProducto($id, $descrip, $precio)
    {

        $sql = "INSERT INTO productos(`pro-id`, `descripcion`,`precio`) VALUES ($id,'$descrip',$precio) ";
        $res = $this->conexion->exec($sql);

        return $res;
    }
}
?>