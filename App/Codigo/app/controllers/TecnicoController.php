<?php
require_once __DIR__ . '/../models/Tecnico.php';
require_once __DIR__ . '/../../config/database.php';

$db = new Database();
$con = $db->conectar();
$tecnico = new Tecnico($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar'])) {
        $resultado = $tecnico->guardar($_POST);

        if (isset($resultado['error'])) {
            $_SESSION['error'] = $resultado['error'];
        }
        if (isset($resultado['actualizar'])) {
            $_SESSION['exito'] = '<div class="alert alert-primary">Tecnico Actualizado correctamente.</div>';
        }
        if (isset($resultado['guardar'])) {
            $_SESSION['exito'] = '<div class="alert alert-success">Tecnico Guardado correctamente.</div>';
        }

    } elseif (isset($_POST['eliminar'])) {
        $tecnico->eliminar($_POST['id']);
        $_SESSION['exito'] = '<div class="alert alert-danger">Tecnico Eliminado correctamente.</div>';
    }

    header("Location: VistaTecnico.php"); 
    exit();
}

$resultado = $tecnico->obtenerTecnico();

?>