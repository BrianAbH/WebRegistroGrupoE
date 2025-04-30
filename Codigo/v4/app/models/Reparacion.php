<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Reparacion.php';

$db = new Database();

    class Reparacion {
        private $con;

        public function __construct($db) {
            $this->con = $db;
        }

        public function guardar($data) {
            extract($data); // Id_Cliente, Tipo, Marca, Modelo, Año
            if ($id) {
                $stmt = $this->con->prepare("UPDATE reparaciones SET Id_Dispositivo=?, Id_Tecnico=?, Repuestos=?, Total_Repuestos=?, Servicio=?, Total_Servicio=?, Fecha_Reparacion=? WHERE Id_Reparacion=?");
                $stmt->bind_param("iisisisi", $movil, $tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $FechaReparacion, $id);
            } else {
                $stmt = $this->con->prepare("INSERT INTO reparaciones (Id_Dispositivo, Id_Tecnico, Repuestos, Total_Repuestos, Servicio, Total_Servicio, Fecha_Reparacion, Activo) VALUES (?, ?, ?, ?, ?, ?, ?,1)");
                $stmt->bind_param("iisisis", $movil, $tecnico, $repuestos, $total_repuestos, $servicio, $total_servicio, $FechaReparacion); 
            }
            return $stmt->execute() ? ['success' => true] : ['error' => $stmt->error];
        }

        public function eliminar($id) {
            $stmt = $this->con->prepare("UPDATE reparaciones SET Activo = 0 WHERE Id_Dispositivo = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

        public function obtenerReparacion() {
            $stmt = $this->con->prepare("SELECT r.Id_Reparacion, c.Nombre_Completo, t.Id_Tecnico,t.Nombre_Tecnico, dm.Id_Dispositivo , dm.Tipo,dm.Marca,dm.Modelo,r.Repuestos,r.Total_Repuestos,
                                        r.Servicio,r.Total_Servicio,r.Fecha_Reparacion
                                        FROM reparaciones r
                                        INNER JOIN 
                                            datosdispositivos dm ON r.Id_Dispositivo = dm.Id_Dispositivo 
                                        INNER JOIN 
                                            datoscliente c ON dm.Id_Cliente = c.Id_Cliente
                                        INNER JOIN 
                                            datostecnico t ON r.Id_Tecnico = t.Id_Tecnico WHERE r.Activo=1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function obtenerDispositivosByCliente() {
            $stmt = $this->con->prepare("SELECT r.Id_Dispositivo, c.Nombre_Completo, r.Modelo FROM datosdispositivos r INNER JOIN datoscliente c ON r.Id_Cliente = c.Id_Cliente WHERE r.activo=1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function obtenerTecnicoById() {
            $stmt = $this->con->prepare("SELECT Id_Tecnico, Nombre_Tecnico  FROM datostecnico WHERE activo=1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

    }

?>