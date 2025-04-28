<?php
// Importa el archivo de configuración de la base de datos
require_once '../config/database.php';
// Crea una nueva instancia de conexión
$db = new Database();
$con = $db->conectar();
$sqlCedula = "SELECT Cedula FROM datostecnico WHERE activo = 1";
$resultadoCedula = $con->query($sqlCedula);
$datosCedula = [];
    if ($resultadoCedula) {
        while ($fila = $resultadoCedula->fetch_assoc()) {
            $datosCedula[] = $fila['Cedula'];
        }
    }

try { 
    // Si se recibió una solicitud para eliminar
    if (!empty($_POST['eliminar'])) {
        eliminarTecnico($con, $_POST);
    }
    // Si se envía una solicitud para guardar (insertar o actualizar
    if (!empty($_POST['guardar'])) {
        guardarTecnico($con, $_POST,$datosCedula);
    } 
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

    function eliminarTecnico($con, $id) {
        // Se obtiene el ID del técnico a eliminar
        $id = $_POST['id'] ?? null;
        if ($id) {
            // Prepara la consulta para desactivar el técnico (eliminación lógica)
            $eliminar = $con->prepare("UPDATE datostecnico SET Activo = 0 WHERE Id_Tecnico = ?");
            $eliminar->bind_param("i", $id);
            if ($eliminar->execute()) {
                // Si se elimina correctamente, redirige al listado de técnicos
                header("Location: DatosTecnico.php?msg=eliminado");
                exit();
            } else {
                // Muestra error si falla la eliminación
                echo "Error al eliminar: " . $eliminar->error;
            }
        }
    }

    function guardarTecnico($con, $id,$datosCedula) {
        // Recoge los datos enviados por POST
        $id = $_POST['id'] ?? null;
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $nombre_completo = $nombre ." ". $apellido;
        $especialidad = $_POST['especialidad'];

        if ($id) {
            // Si hay un ID, actualiza un técnico existente
            actualizarCliente($con,$cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad, $id);
        } else {
            // Si no hay ID, inserta un nuevo técnico
            insertarTecnico($con, $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad,$datosCedula) ;
        }
    }

    function actualizarCliente($con,$cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad, $id){
        $actualizar = $con->prepare("UPDATE datostecnico SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Nombre_Tecnico=?, Especialidad=? WHERE Id_Tecnico=?");
        $actualizar->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad, $id);
        if ($actualizar->execute()) {
            // Redirige tras actualizar exitosamente
            header("Location: DatosTecnico.php?msg=actualizado");
            exit();
        } else {
            // Muestra error si falla la actualización
            echo "Error al actualizar: " . $actualizar->error;
        }
    }

    function insertarTecnico($con, $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad,$datosCedula){
        // Si no hay ID, se debe insertar un nuevo cliente
        if(validarCedulaT($datosCedula, $cedula)){
            echo'<div class="alert alert-danger"> El usuario ya esta registrado </div>';       
        } else {
            $insertar = $con->prepare("INSERT INTO datostecnico (Cedula, Nombres, Apellidos, Telefono, Nombre_Tecnico, Especialidad, Activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
            $insertar->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad);
            if ($insertar->execute()) {
                // Redirige tras insertar exitosamente
                header("Location: DatosTecnico.php?msg=insertado");
                exit();
            } else {
                // Muestra error si falla la inserción
                echo "Error al insertar: " . $insertar->error;
            }
        }
    }
    function validarCedulaT($datos, $cedula) {
        return in_array($cedula, $datos);
    }
?>

