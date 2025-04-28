<?php
// Incluye el archivo de configuración de la base de datos
require_once '../model/config/database.php';
// Crea una instancia para conectar a la base de datos
$db = new Database();
$con = $db->conectar();
$sqlCedula = "SELECT Cedula FROM datoscliente WHERE activo = 1";
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
        eliminarCliente($con, $_POST);
    }
    // Si se envía una solicitud para guardar (insertar o actualizar
    if (!empty($_POST['guardar'])) {
        crearCliente($con, $_POST,$datosCedula);
    }  
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


    function crearCliente($con, $id,$datosCedula) {
        $id = $_POST['id'] ?? null;
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $nombre_completo = $nombre ." ". $apellido;
        if ($id) {
            // Si existe ID, significa que se debe actualizar el cliente existente
            actualizarCliente($con,$cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo, $id);
        } else {
            insertarCliente($con, $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo,$datosCedula);
        }
    }

    function actualizarCliente($con,$cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo, $id){
        $actualizar = $con->prepare("UPDATE datoscliente SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Direccion=?, Nombre_Completo=? WHERE Id_Cliente=?");
        $actualizar->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo, $id);
        if ($actualizar->execute()) {
            // Redirige tras actualizar exitosamente
            header("Location: DatosCliente.php?msg=actualizado");
            exit();
        } else {
            // Muestra error si falla la actualización
            echo "Error al actualizar: " . $actualizar->error;
        }
    }

    function insertarCliente($con, $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo,$datosCedula){
        // Si no hay ID, se debe insertar un nuevo cliente
        if(validarCedulaC($datosCedula, $cedula)){
            echo'<div class="alert alert-danger"> El usuario ya esta registrado </div>';       
        } else {
            $insertar = $con->prepare("INSERT INTO datoscliente (Cedula, Nombres, Apellidos, Telefono, Direccion, Nombre_Completo, activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
            $insertar->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo);
            if ($insertar->execute()) {
                // Redirige tras insertar exitosamente
                header("Location: DatosCliente.php?msg=insertado");
                exit();
            } else {
                // Muestra error si falla la inserción
                echo "Error al insertar: " . $insertar->error;
            }
        }
    }

    function eliminarCliente($con, $id) {
        if ($id) {
            // Prepara la consulta SQL para "desactivar" al cliente (no lo elimina físicamente)
            $eliminar = $con->prepare("UPDATE datoscliente SET Activo = 0 WHERE Id_Cliente = ?");
            $eliminar->bind_param("i", $id);
            if ($eliminar->execute()) {
                // Si la eliminación fue exitosa, redirige a la página de clientes
                header("Location: DatosCliente.php?msg=eliminado");
                exit();
            } else {
                // Si hay error, muestra mensaje
                echo "Error al eliminar: " . $eliminar->error;
            }
        }
    }

    function validarCedulaC($datos, $cedula) {
        return in_array($cedula, $datos);
    }

?>
