<?php
require_once __DIR__ . '/../models/Reparacion.php';
require_once __DIR__ . '/../../config/database.php';

$db = new Database();
$con = $db->conectar();
$reparacion = new Reparacion($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar'])) {
        $resultado = $reparacion->guardar($_POST);

        if (isset($resultado['actualizar'])) {
            $_SESSION['exito'] = '<div class="alert alert-primary">Reparacion Actualizado correctamente.</div>';
        }
        if (isset($resultado['guardar'])) {
            $_SESSION['exito'] = '<div class="alert alert-success">Reparacion Guardado correctamente.</div>';
        }
    } elseif (isset($_POST['eliminar'])) {
        $reparacion->eliminar($_POST['id']);
        $_SESSION['exito'] = '<div class="alert alert-danger">Reparacion Eliminado correctamente.</div>';
    }
    

    header("Location: vistaReparaciones.php"); 
    exit();
}

$resultado = $reparacion->obtenerReparacion();
$dispositivo = $reparacion->obtenerDispositivosByCliente();
$tecnico = $reparacion->obtenerTecnicoById();

?>