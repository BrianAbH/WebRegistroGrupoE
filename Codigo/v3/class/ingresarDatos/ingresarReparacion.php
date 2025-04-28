<?php
// Importa el archivo de configuración de la base de datos
require_once '../config/database.php';
// Crea una nueva instancia de la conexión a la base de datos
$db = new Database();
$con = $db->conectar();

try {
    // Si se recibió una solicitud para eliminar
    if (!empty($_POST['eliminar'])) {
        eliminarReparacion($con, $_POST['id']);
    }
    // Si se recibió una solicitud para guardar (crear o actualizar)
    if (!empty($_POST['guardar'])) {
        guardarReparacion($con, $_POST);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

    function guardarReparacion($con, $id) {
        // Se obtienen todos los datos enviados desde el formulario
        $id = $_POST['id'] ?? null;
        $id_movil = $_POST['movil'];
        $id_tecnico = $_POST['tecnico'];
        $repuestos = $_POST['repuestos'];
        $total_repuestos = $_POST['total_repuestos'];
        $servicio = $_POST['servicio'];
        $total_servicio = $_POST['total_servicio'];
        $Fecha_Reparacion = $_POST['FechaReparacion'];
        if ($id) {
            // Si existe un ID, se actualiza la reparación existente
            actualizarReparacion($con,$id_movil, $id_tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $Fecha_Reparacion, $id);
        } else {
            // Si no existe ID, se inserta una nueva reparación
            insertarReparacion($con,$id_movil, $id_tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $Fecha_Reparacion) ;
        }
    }

    function insertarReparacion($con,$id_movil, $id_tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $Fecha_Reparacion){
        $insertar = $con->prepare("INSERT INTO reparaciones (Id_Movil, Id_Tecnico, Repuestos, Total_Repuestos, Servicio, Total_Servicio, Fecha_Reparacion, Activo) VALUES (?, ?, ?, ?, ?, ?, ?,1)");
        $insertar->bind_param("iisisis", $id_movil, $id_tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $Fecha_Reparacion);
            if ($insertar->execute()) {
                // Redirige si la inserción fue exitosa
                header("Location: Reparaciones.php?msg=insertado");
                exit();
            } else {
                // Muestra un error si falla la inserción
                echo "Error al insertar: " . $insertar->error;
            }
    }
    
    function actualizarReparacion($con,$id_movil, $id_tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $Fecha_Reparacion, $id){
        $actualizar = $con->prepare("UPDATE reparaciones SET Id_Movil=?, Id_Tecnico=?, Repuestos=?, Total_Repuestos=?, Servicio=?, Total_Servicio=?, Fecha_Reparacion=? WHERE Id_Reparacion=?");
        $actualizar->bind_param("iisisisi", $id_movil, $id_tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $Fecha_Reparacion, $id);
        if ($actualizar->execute()) {
        // Si se actualizó correctamente, redirige
        header("Location: Reparaciones.php");
        exit();
        } else {
            // Muestra un error si falla
            echo "Error al actualizar: " . $actualizar->error;
        }
    }
    
    function eliminarReparacion($con, $id) {
        // Se obtiene el ID de la reparación a eliminar
        $id = $_POST['id'] ?? null;
        if ($id) {
            // Prepara la sentencia para marcar como inactiva la reparación (no eliminar físicamente)
            $eliminar = $con->prepare("UPDATE reparaciones SET activo = 0 WHERE Id_Reparacion = ?");
            $eliminar->bind_param("i", $id);
        if ($eliminar->execute()) {
            // Si se ejecutó correctamente, redirige a la página principal
            header("Location: Reparaciones.php");
            exit();
        } else {
            // Si hubo un error, lo muestra
            echo "Error al eliminar: " . $eliminar->error;
            }
        }
        
    }

?>
