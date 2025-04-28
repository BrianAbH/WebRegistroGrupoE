<?php
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();
$sqlCliente = "SELECT Id_Cliente, Nombres, Apellidos FROM datoscliente WHERE activo=1";
$resultadoCliente = $con->query($sqlCliente);

$sqlMovil = "SELECT r.Id_Movil,r.Id_Cliente, c.Nombre_Completo, c.Apellidos, r.Tipo, r.Marca, r.Modelo, r.Año, r.Activo FROM datosmovil r INNER JOIN datoscliente c ON r.Id_Cliente = c.Id_Cliente WHERE r.Activo=1";
$resultadoMovil = $con->query($sqlMovil);
$datos = [];
    if ($resultadoMovil) {
        while ($fila = $resultadoMovil->fetch_assoc()) {
            $datos[] = $fila;
        }
    }
?>

