<?php
require_once __DIR__ . '/../models/Dispositivo.php';
require_once __DIR__ . '/../../config/database.php';

$db = new Database();
$con = $db->conectar();
$dispositivo = new Dispositivo($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar'])) {
        $resultadoD = $dispositivo->guardar($_POST);

        if (isset($resultadoD['error'])) {
            $_SESSION['error'] = $resultadoD['error'];
        } else {
            $_SESSION['exito'] = 'Dispositivo guardado correctamente.';
        }
    } elseif (isset($_POST['eliminar'])) {
        $dispositivo->eliminar($_POST['id']);
        $_SESSION['exito'] = 'Dispositivo eliminado correctamente.';
    }

    header("Location: vistaDispositivo.php"); 
    exit();
}

$resultadoD = $dispositivo->obtenerDispositivos();
$resultadoByCliente = $dispositivo->obtenerByCliente();

?>