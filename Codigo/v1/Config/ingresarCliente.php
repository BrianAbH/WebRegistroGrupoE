<?php
require_once 'database.php';
$db = new Database();
$con = $db->conectar();
    if (!empty($_POST['guardar'])) {
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        
        $insertar = $con->query("INSERT INTO datoscliente (Cedula, Nombres, Apellidos, Telefono, Direccion, Activo) VALUES ('$cedula', '$nombre', '$apellido', '$telefono', '$direccion',1)");
        if ($insertar==1) {
            // Redirige después de insertar para evitar reenvío
            header("Location: DatosCliente.php");
            echo '<div class="alert alert-success">Cliente Registrado Correctamente</div>';
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . $con->error;
        }
    }
?>