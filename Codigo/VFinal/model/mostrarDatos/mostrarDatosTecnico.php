<?php
require_once '../model/config/database.php';
$db = new Database();
$con = $db->conectar();
$sql = "SELECT Id_Tecnico, Cedula, Nombres, Apellidos, Telefono, Especialidad, Activo FROM datostecnico WHERE activo=1";
$resultado = $con->query($sql);
$datos = [];
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    }
?>