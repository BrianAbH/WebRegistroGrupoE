<?php
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

// Si se está intentando eliminar
if (!empty($_POST['eliminar'])) {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $eliminar = $con->prepare("UPDATE datoscliente SET Activo = 0 WHERE Id_Cliente = ?");
        $eliminar->bind_param("i", $id);
        if ($eliminar->execute()) {
            // Eliminado correctamente
            header("Location: DatosCliente.php");
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
    $direccion = $_POST['direccion'];
    $nombre_completo = json_encode($nombre.' '.$apellido);
    
    if ($id) {
        //Actualizar cliente existente
        $actualizar = $con->prepare("UPDATE datoscliente SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Direccion=?, Nombre_Completo=? WHERE Id_Cliente=?");
        $actualizar->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo, $id);
        if ($actualizar->execute()) {
            header("Location: DatosCliente.php");
            exit();
        } else {
            echo "Error al actualizar: " . $actualizar->error;
        }
    } else {
        //Insertar nuevo cliente
        $insertar = $con->prepare("INSERT INTO datoscliente (Cedula, Nombres, Apellidos, Telefono, Direccion, Nombre_Completo, activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
        $insertar->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $direccion,$nombre_completo);
        if ($insertar->execute()) {
            header("Location: DatosCliente.php?msg=insertado");
            exit();
        } else {
            echo "Error al insertar: " . $insertar->error;
        }
    }
}
?>
