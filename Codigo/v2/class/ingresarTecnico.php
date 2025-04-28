<?php
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

// Si se está intentando eliminar
if (!empty($_POST['eliminar'])) {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $eliminar = $con->prepare("UPDATE datostecnico SET Activo = 0 WHERE Id_Tecnico = ?");
        $eliminar->bind_param("i", $id);
        if ($eliminar->execute()) {
            // Eliminado correctamente
            header("Location: DatosTecnico.php");
            exit();
        } else {
            echo "Error al eliminar: " . $eliminar->error;
        }
    }
}

// Si se está guardando o actualizando
if (!empty($_POST['guardar'])) {
    $id = $_POST['id'] ?? null;
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $especialidad = $_POST['especialidad'];

    if ($id) {
        //Actualizar tecnico existente
        $actualizar = $con->prepare("UPDATE datostecnico SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Especialidad=? WHERE Id_Tecnico=?");
        $actualizar->bind_param("sssssi", $cedula, $nombre, $apellido, $telefono, $especialidad, $id);
        if ($actualizar->execute()) {
            header("Location: DatosTecnico.php");
            exit();
        } else {
            echo "Error al actualizar: " . $actualizar->error;
        }
    } else {
        //Insertar nuevo tecnico
        $insertar = $con->prepare("INSERT INTO datostecnico (Cedula, Nombres, Apellidos, Telefono, Especialidad, Activo) VALUES (?, ?, ?, ?, ?, 1)");
        $insertar->bind_param("sssss", $cedula, $nombre, $apellido, $telefono, $especialidad);
        if ($insertar->execute()) {
            header("Location: DatosTecnico.php");
            exit();
        } else {
            echo "Error al insertar: " . $insertar->error;
        }
    }
}
?>
