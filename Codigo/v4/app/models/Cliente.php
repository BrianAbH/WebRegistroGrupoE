<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Cliente.php';

$db = new Database();

    class Cliente {
        private $con;

        public function __construct($db) {
            $this->con = $db;
        }

        public function guardar($data) {
            extract($data); // cedula, nombre, apellido, telefono, direccion, id
            $nombre_completo = "$nombre $apellido";

            if ($this->cedulaExiste($cedula, $id)) return $_SESSION['error'] = 'Ya existe un cliente con esa cédula';

            if ($id) {
                $stmt = $this->con->prepare("UPDATE datoscliente SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Direccion=?, Nombre_Completo=? WHERE Id_Cliente=?");
                $stmt->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo, $id);

            } else {
                $stmt = $this->con->prepare("INSERT INTO datoscliente (Cedula, Nombres, Apellidos, Telefono, Direccion, Nombre_Completo, Activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
                $stmt->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo); 
                
            }
            return $stmt->execute() ? ['success' => true] : ['error' => $stmt->error];
        }

        public function eliminar($id) {
            $stmt = $this->con->prepare("UPDATE datoscliente SET Activo = 0 WHERE Id_Cliente = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

        public function obtenerClientes() {
            $stmt = $this->con->prepare("SELECT * FROM datoscliente WHERE Activo = 1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function cedulaExiste($cedula, $id = null) {
            if ($id) {
                $stmt = $this->con->prepare("SELECT 1 FROM datoscliente WHERE Cedula = ? AND Id_Cliente != ? AND Activo = 1");
                $stmt->bind_param("si", $cedula, $id);
            } else {
                $stmt = $this->con->prepare("SELECT 1 FROM datoscliente WHERE Cedula = ? AND Activo = 1");
                $stmt->bind_param("s", $cedula);
            }
            $stmt->execute();
            return $stmt->get_result()->num_rows > 0;
        }

        public function obtenerNombres() {
            $stmt = $this->con->prepare("SELECT Id_Cliente, Nombre_Completo FROM datoscliente WHERE Activo=1");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    
    }

?>