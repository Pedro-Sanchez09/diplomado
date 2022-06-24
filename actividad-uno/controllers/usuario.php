<?php


require_once("../models/Cliente.php");



$cliente = new Cliente();
$respuesta;


switch ($_GET["op"]) {
    case 'getSession':
        session_start();
        if (isset($_SESSION['usuario'])) {
            $respuesta=array('usuario'=>$_SESSION['usuario'],'usuario_id'=>$_SESSION['usuario_id']);
            echo json_encode($respuesta);
        } else {
            echo json_encode('No hay session: usuario');
        }
        break;

    case 'validLogin':

        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $res = $cliente->validarCliente($user, $pass);
        $respuesta = $res['DATA'];
        if (sizeof($respuesta) > 0) {
            $respuesta = $res['DATA'][0];
            session_start();
            $_SESSION['usuario'] = $respuesta['nombre'];
            $_SESSION['rol'] = $respuesta['rol'];
            $_SESSION['usuario_id'] = $respuesta['cedula'];
            $respuesta = "OK";
        } else {
            $respuesta = "ERROR";
        }


        echo json_encode($respuesta);
        break;
    case 'validUser';
        $user = $_POST['user'];
        $res = $cliente->validarUsuario($user);
        $respuesta = $res['DATA'];

        echo json_encode($respuesta);

        break;

    case 'crearUsuario';
        $cc = intval($_POST['cc']);
        $respuesta = $cliente->getCliente($cc);
        $respuesta = $respuesta['DATA'];
        if (sizeof($respuesta) > 0) {
            $respuesta = array('STATUS' => 'ERROR', 'Mensage' => 'Cliente existe en el sistema!');
        } else {
            $respuesta = $cliente->crearUsuarioCliente($_POST['usuario'], $_POST['password'], $_POST['rol']);
            if ($respuesta['STATUS'] = 'OK') {
                $respuesta = $cliente->guardarCliente($cc, $_POST['nombres'], $_POST['direccion'], $_POST['celular'], $_POST['usuario']);
            }
        }
        echo json_encode($respuesta);

        break;


    default:
        # code...
        break;
}
