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
        } else {
            $_SESSION['exito'] = 'Cliente guardado correctamente.';
        }
    } elseif (isset($_POST['eliminar'])) {
        $cliente->eliminar($_POST['id']);
        $_SESSION['exito'] = 'Cliente eliminado correctamente.';
    }

    header("Location: VistaCliente.php"); 
    exit();
}

$resultado = $cliente->obtenerClientes();

?>