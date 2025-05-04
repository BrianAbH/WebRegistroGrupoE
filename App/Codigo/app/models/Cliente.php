<?php
// Se incluyen los archivos necesarios para la conexión a la base de datos y el modelo Cliente.
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Cliente.php';

$db = new Database(); // Se crea una instancia de la clase Database.

// Definición de la clase Cliente (modelo)
class Cliente {
    private $con; // Variable para almacenar la conexión a la base de datos

    // Constructor que recibe la conexión de base de datos y la asigna a la propiedad $con
    public function __construct($db) {
        $this->con = $db;
    }

    // Método para guardar o actualizar un cliente
    public function guardar($data) {
        extract($data); // Extrae variables desde el array asociativo: cedula, nombre, apellido, etc.
        $nombre_completo = "$nombre $apellido"; // Se concatena nombre y apellido para guardar el nombre completo

        // Verifica si ya existe un cliente con esa cédula (y diferente ID si es una actualización)
        if ($this->cedulaExiste($cedula, $id)) 
            return $_SESSION['error'] = 'Ya existe un cliente con esa cédula';

        // Si se proporciona un ID, se hace un UPDATE (actualización)
        if ($id) {
            $stmt = $this->con->prepare("UPDATE datoscliente 
                                         SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Direccion=?, Nombre_Completo=? 
                                         WHERE Id_Cliente=?");
            $stmt->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo, $id);
            return $stmt->execute() ? ['actualizar' => true] : ['error' => $stmt->error];

        } else {
            // Si no hay ID, se hace un INSERT (registro nuevo)
            $stmt = $this->con->prepare("INSERT INTO datoscliente 
                                         (Cedula, Nombres, Apellidos, Telefono, Direccion, Nombre_Completo, Activo) 
                                         VALUES (?, ?, ?, ?, ?, ?, 1)");
            $stmt->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $direccion, $nombre_completo); 
            return $stmt->execute() ? ['guardar' => true] : ['error' => $stmt->error];
        }
    }

    // Método para eliminar un cliente (eliminación lógica, no se borra de la BD)
    public function eliminar($id) {
        $stmt = $this->con->prepare("UPDATE datoscliente SET Activo = 0 WHERE Id_Cliente = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Método para obtener todos los clientes activos
    public function obtenerClientes() {
        $stmt = $this->con->prepare("SELECT * FROM datoscliente WHERE Activo = 1");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Método para verificar si una cédula ya está registrada (para evitar duplicados)
    public function cedulaExiste($cedula, $id = null) {
        if ($id) {
            // Si hay un ID, se excluye ese ID en la búsqueda (útil al actualizar)
            $stmt = $this->con->prepare("SELECT 1 FROM datoscliente WHERE Cedula = ? AND Id_Cliente != ? AND Activo = 1");
            $stmt->bind_param("si", $cedula, $id);
        } else {
            // Si no hay ID (es un nuevo registro), se verifica si la cédula ya existe
            $stmt = $this->con->prepare("SELECT 1 FROM datoscliente WHERE Cedula = ? AND Activo = 1");
            $stmt->bind_param("s", $cedula);
        }
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0; // Retorna true si ya existe, false si no
    }
}
?>
