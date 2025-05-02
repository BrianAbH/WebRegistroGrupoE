<?php
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../../config/database.php';

$db = new Database();
$con = $db->conectar();
$cliente = new Cliente($con);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['guardar'])) {
            $resultado = $cliente->guardar($_POST);
    
            if (isset($resultado['error'])) {
                $_SESSION['error'] = $resultado['error'];
            }
            if (isset($resultado['actualizar'])) {
                $_SESSION['exito'] = '<div class="alert alert-primary">Cliente Actualizado correctamente.</div>';
            }
            if (isset($resultado['guardar'])) {
                $_SESSION['exito'] = '<div class="alert alert-success">Cliente Guardado correctamente.</div>';
            }
    
        } elseif (isset($_POST['eliminar'])) {
            $cliente->eliminar($_POST['id']);
            $_SESSION['exito'] = '<div class="alert alert-danger">Cliente Eliminado correctamente.</div>';
        }
    
        header("Location: VistaCliente.php"); 
        exit();
    }


$resultado = $cliente->obtenerClientes();

?>