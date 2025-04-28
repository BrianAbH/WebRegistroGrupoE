<?php
// Incluye el archivo de conexión a la base de datos
require_once '../model/config/database.php';
// Crea una instancia de la conexión a la base de datos
$db = new Database();
$con = $db->conectar();
try {
    // Si se recibe una solicitud para eliminar un registro
    if (!empty($_POST['eliminar'])) {
        eliminarMovil($con, $_POST);
    }
    // Si se recibe una solicitud para guardar (crear o actualizar un móvil)
    if (!empty($_POST['guardar'])) {
        crearMovil($con, $_POST);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

    function crearMovil($con, $id) {
        // Recoge los datos enviados mediante el formulario
        $id = $_POST['id'] ?? null;
        $cliente = $_POST['cliente'];
        $tipo = $_POST['tipo'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $anio = $_POST['anio'];

        if ($id) {
            // Si existe un ID, actualiza un móvil existente
            ActualizarMovil($con,$cliente, $tipo, $marca, $modelo, $anio, $id); 
        } else {
            // Si no hay ID, inserta un nuevo móvil
            insertarMovil($con,$cliente,  $tipo, $marca, $modelo, $anio);
        }     
    }

    function insertarMovil($con,$cliente,  $tipo, $marca, $modelo, $anio){
        $insertar = $con->prepare("INSERT INTO datosmovil (Id_Cliente, Tipo, Marca, Modelo, Año, Activo) VALUES (?, ?, ?, ?, ?, 1)");
        $insertar->bind_param("sssss", $cliente,  $tipo, $marca, $modelo, $anio);
        if ($insertar->execute()) {
            // Redirige tras insertar exitosamente
            header("Location: DatosMovil.php?msg=TecnicoIngresado");
            exit();
        } else {
            // Muestra un error si la inserción falla
            echo "Error al insertar: " . $insertar->error;
        } 
    }

    function ActualizarMovil($con,$cliente, $tipo, $marca, $modelo, $anio, $id){
        $actualizar = $con->prepare("UPDATE datosmovil SET Id_Cliente=?, Tipo=?, Marca=?, Modelo=?, Año=? WHERE Id_Movil=?");
        $actualizar->bind_param("sssssi", $cliente, $tipo, $marca, $modelo, $anio, $id);
        if ($actualizar->execute()) {
            // Redirige tras actualizar exitosamente
            header("Location: DatosMovil.php?msg=tecnicoActualizado");
            exit();
        } else {
            // Muestra un error si la actualización falla
            echo "Error al actualizar: " . $actualizar->error;
        }
    }

    function eliminarMovil($con, $id) {
        // Obtiene el ID del móvil a eliminar
        $id = $_POST['id'] ?? null;
        if ($id) {
            // Prepara la consulta para desactivar el móvil (eliminación lógica)
            $eliminar = $con->prepare("UPDATE datosmovil SET Activo = 0 WHERE Id_Movil = ?");
            $eliminar->bind_param("i", $id);
            if ($eliminar->execute()) {
                // Redirige a la página principal de móviles tras eliminar
                header("Location: DatosMovil.php");
                exit();
            } else {
                // Muestra un mensaje de error si falla la eliminación
                echo "Error al eliminar: " . $eliminar->error;
            }
        }
    }
    

?>
