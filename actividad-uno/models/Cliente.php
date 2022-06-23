<?php
require_once("../config-bd/conexion.php");
class Cliente
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
    }

    public function getCliente($id)
    {
        $sql = "SELECT * FROM clientes where cedula='$id'";
        $resB = $this->conexion->get_data($sql);
        return $resB;
    }
}
