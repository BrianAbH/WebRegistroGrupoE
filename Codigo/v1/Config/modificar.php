<?php
require_once 'database.php';
$db = new Database();
$con = $db->conectar();
$id =$_GET["Id_Cliente"];
$sqlClien = $con->query("select * from datoscliente where Id_Cliente = $id");

?>