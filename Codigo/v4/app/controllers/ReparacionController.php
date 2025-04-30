<?php
require_once __DIR__ . '/../models/Reparacion.php';
require_once __DIR__ . '/../../config/database.php';

$db = new Database();
$con = $db->conectar();
$reparacion = new Reparacion($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar'])) {
        $resultado = $reparacion->guardar($_POST);

        if (isset($resultado['error'])) {
            $_SESSION['error'] = $resultado['error'];
        } else {
            $_SESSION['exito'] = 'Reparacion guardada correctamente.';
        }
    } elseif (isset($_POST['eliminar'])) {
        $reparacion->eliminar($_POST['id']);
        $_SESSION['exito'] = 'Reparacion eliminada correctamente.';
    }

    header("Location: vistaReparaciones.php"); 
    exit();
}

$resultado = $reparacion->obtenerReparacion();
$dispositivo = $reparacion->obtenerDispositivosByCliente();
$tecnico = $reparacion->obtenerTecnicoById();

?>