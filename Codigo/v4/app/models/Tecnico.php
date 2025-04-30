<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Cliente.php';

$db = new Database();

    class Tecnico {
        private $con;

        public function __construct($db) {
            $this->con = $db;
        }

        public function guardar($data) {
            extract($data); // cedula, nombre, apellido, telefono, direccion, especialidad, id
            $nombre_completo = "$nombre $apellido";

            if ($this->cedulaExiste($cedula, $id)) return $_SESSION['error'] = 'Ya existe un tecnico con esa cédula';

            if ($id) {
                $stmt = $this->con->prepare("UPDATE datostecnico SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Nombre_Tecnico=?, Especialidad=? WHERE Id_Tecnico=?");
                $stmt->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad, $id);
            } else {
                $stmt = $this->con->prepare("INSERT INTO datostecnico (Cedula, Nombres, Apellidos, Telefono, Nombre_Tecnico, Especialidad, Activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
                $stmt->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad); 
            }
            return $stmt->execute() ? ['success' => true] : ['error' => $stmt->error];
        }

        public function eliminar($id) {
            $stmt = $this->con->prepare("UPDATE datostecnico SET Activo = 0 WHERE Id_Tecnico = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

        public function obtenerTecnico() {
            $stmt = $this->con->prepare("SELECT * FROM datostecnico WHERE Activo = 1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function cedulaExiste($cedula, $id = null) {
            if ($id) {
                $stmt = $this->con->prepare("SELECT 1 FROM datostecnico WHERE Cedula = ? AND Id_Tecnico != ? AND Activo = 1");
                $stmt->bind_param("si", $cedula, $id);
            } else {
                $stmt = $this->con->prepare("SELECT 1 FROM datostecnico WHERE Cedula = ? AND Activo = 1");
                $stmt->bind_param("s", $cedula);
            }
            $stmt->execute();
            return $stmt->get_result()->num_rows > 0;
        }
    }

?>