<?php
require_once '../config/database.php';
$db = new Database();
$con = $db->conectar();
$sql = "SELECT Id_Cliente, Cedula, Nombres, Apellidos, Telefono, Direccion, Activo FROM datoscliente WHERE activo=1";
$resultado = $con->query($sql);
$datos = [];
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    }
?>