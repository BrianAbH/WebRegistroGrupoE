<?php
require_once '../config/database.php';
$db = new Database();
$con = $db->conectar();
$sqlMovil = "SELECT r.Id_Movil, c.Nombre_Completo, r.Modelo FROM datosmovil r INNER JOIN datoscliente c ON r.Id_Cliente = c.Id_Cliente WHERE r.activo=1";
$resultadoMovil = $con->query($sqlMovil);

$sqlTecnico = "SELECT Id_Tecnico, Nombre_Tecnico  FROM datostecnico WHERE activo=1";
$resultadoTecnico= $con->query($sqlTecnico);

$sqlReparaciones = "SELECT r.Id_Reparacion,c.Nombre_Completo, t.Id_Tecnico, t.Nombre_Tecnico, dm.Id_Movil, dm.Tipo,dm.Marca,dm.Modelo,r.Repuestos,r.Total_Repuestos,
                    r.Servicio,r.Total_Servicio,r.Fecha_Reparacion
FROM reparaciones r
INNER JOIN 
    datosmovil dm ON r.Id_Movil = dm.Id_Movil
INNER JOIN 
    datoscliente c ON dm.Id_Cliente = c.Id_Cliente
INNER JOIN 
    datostecnico t ON r.Id_Tecnico = t.Id_Tecnico WHERE r.Activo=1";
$resultadoReparaciones = $con->query($sqlReparaciones);
$datos = [];
if ($resultadoReparaciones) {
    while ($fila = $resultadoReparaciones->fetch_assoc()) {
        $datos[] = $fila;
    }
}


?>

