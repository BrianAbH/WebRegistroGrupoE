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
        } else {
            $_SESSION['exito'] = 'Cliente guardado correctamente.';
        }
    } elseif (isset($_POST['eliminar'])) {
        $tecnico->eliminar($_POST['id']);
        $_SESSION['exito'] = 'Cliente eliminado correctamente.';
    }

    header("Location: VistaTecnico.php"); 
    exit();
}

$resultado = $tecnico->obtenerTecnico();

?>