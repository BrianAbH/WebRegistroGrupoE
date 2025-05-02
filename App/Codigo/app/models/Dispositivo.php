<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Dispositivo.php';

$db = new Database();

    class Dispositivo {
        private $con;

        public function __construct($db) {
            $this->con = $db;
        }

        public function guardar($data) {
            extract($data); // Id_Cliente, Tipo, Marca, Modelo, Año
            if ($id) {
                $stmt = $this->con->prepare("UPDATE datosdispositivos SET Id_Cliente=?, Tipo=?, Marca=?, Modelo=?, Año=? WHERE Id_Dispositivo=?");
                $stmt->bind_param("sssssi", $cliente, $tipo, $marca, $modelo, $anio, $id);
                return $stmt->execute() ? ['actualizar' => true] : ['error' => $stmt->error];
            } else {
                $stmt = $this->con->prepare("INSERT INTO datosdispositivos (Id_Cliente, Tipo, Marca, Modelo, Año, Activo) VALUES (?, ?, ?, ?, ?, 1)");
                $stmt->bind_param("sssss", $cliente,  $tipo, $marca, $modelo, $anio); 
                return $stmt->execute() ? ['guardar' => true] : ['error' => $stmt->error];
            }
        }

        public function eliminar($id) {
            $stmt = $this->con->prepare("UPDATE datosdispositivos SET Activo = 0 WHERE Id_Dispositivo = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

        public function obtenerDispositivos() {
            $stmt = $this->con->prepare("SELECT r.Id_Dispositivo, r.Id_Cliente, c.Nombre_Completo, c.Apellidos, r.Tipo, r.Marca, r.Modelo, r.Año, r.Activo FROM datosdispositivos r INNER JOIN datoscliente c ON r.Id_Cliente = c.Id_Cliente WHERE r.Activo=1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        
        public function obtenerByCliente() {
            $stmt = $this->con->prepare("SELECT Id_Cliente, Nombre_Completo FROM datoscliente WHERE Activo = 1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    }

?>