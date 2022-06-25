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
        $sql = "SELECT `usuarios`.rol FROM clientes
        INNER join usuarios
        ON usuarios.usuario=clientes.usuario 
        where  clientes.cedula='$id' ";
        $resB = $this->conexion->get_data($sql);
        return $resB;
    }
    

    public function validarCliente($user, $pass)
    {
        $sql = "SELECT `clientes`.nombre, `clientes`.cedula,`clientes`.usuario,`usuarios`.rol FROM clientes
        INNER join usuarios
        ON usuarios.usuario=clientes.usuario 
        where  usuarios.usuario='$user' and  usuarios.password='$pass'";
        $res = $this->conexion->get_data($sql);
        return $res;
    }

    public function validarUsuario($user)
    {
        $sql = "SELECT usuario,rol FROM usuarios where usuario='$user'";
        $res = $this->conexion->get_data($sql);
        return $res;
    }

    public function crearUsuarioCliente($usuario, $pass, $rol)
    {

        $guardarUsuario = "INSERT INTO usuarios (`usuario`, `password`, `rol`) VALUES ('$usuario', '$pass', '$rol')";
        $res = $this->conexion->exec($guardarUsuario);
        return $res;
    }

    public function guardarCliente($cc, $nombre, $direccion, $telefono, $usuario)
    {
        $guardarCliente = "INSERT INTO clientes (`cedula`, `nombre`, `direccion`,`telefono`,`usuario`) VALUES ('$cc', '$nombre', '$direccion','$telefono','$usuario')";
        $res = $this->conexion->exec($guardarCliente);
        return $res;
    }
}
