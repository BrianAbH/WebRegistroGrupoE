<?php
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

// Si se está intentando eliminar
if (!empty($_POST['eliminar'])) {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $eliminar = $con->prepare("UPDATE datosmovil SET Activo = 0 WHERE Id_Movil = ?");
        $eliminar->bind_param("i", $id);
        if ($eliminar->execute()) {
            // Eliminado correctamente
            header("Location: DatosMovil.php");
            exit();
        } else {
            echo "Error al eliminar: " . $eliminar->error;
        }
    }
}

// Si se está guardando o actualizando
if (!empty($_POST['guardar'])) {
    $id = $_POST['id'] ?? null;
    $cliente = $_POST['cliente'];
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];

    if ($id) {
        //Actualizar movil existente
        $actualizar = $con->prepare("UPDATE datosmovil SET Id_Cliente=?, Tipo=?, Marca=?, Modelo=?, Año=? WHERE Id_Movil=?");
        $actualizar->bind_param("sssssi", $cliente, $tipo, $marca, $modelo, $anio, $id);
        if ($actualizar->execute()) {
            header("Location: DatosMovil.php");
            exit();
        } else {
            echo "Error al actualizar: " . $actualizar->error;
        }
    } else {
        //Insertar nuevo movil
        $insertar = $con->prepare("INSERT INTO datosmovil (Id_Cliente, Tipo, Marca, Modelo, Año, Activo) VALUES (?, ?, ?, ?, ?, 1)");
        $insertar->bind_param("sssss", $cliente,  $tipo, $marca, $modelo,$anio);
        if ($insertar->execute()) {
            header("Location: DatosMovil.php");
            exit();
        } else {
            echo "Error al insertar: " . $insertar->error;
        }
    }
}
?>
