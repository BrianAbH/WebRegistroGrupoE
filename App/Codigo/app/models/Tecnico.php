<?php
// Inclusión del archivo de configuración de base de datos
require_once __DIR__ . '/../../config/database.php';

$db = new Database(); // Instancia de conexión a la base de datos

// Definición de la clase Tecnico
class Tecnico {
    private $con; // Propiedad para almacenar la conexión

    // Constructor que inicializa la conexión a la base de datos
    public function __construct($db) {
        $this->con = $db;
    }

    // Método para guardar (insertar o actualizar) un técnico
    public function guardar($data) {
        extract($data); // Extrae variables de $data: $cedula, $nombre, $apellido, etc.
        $nombre_completo = "$nombre $apellido"; // Se genera el nombre completo del técnico

        // Verifica si ya existe un técnico con la misma cédula
        if ($this->cedulaExiste($cedula, $id)) return $_SESSION['error'] = 'Ya existe un tecnico con esa cédula';

        if ($id) {
            // Si se recibe un ID, se actualiza el registro del técnico
            $stmt = $this->con->prepare("UPDATE datostecnico 
                                         SET Cedula=?, Nombres=?, Apellidos=?, Telefono=?, Nombre_Tecnico=?, Especialidad=? 
                                         WHERE Id_Tecnico=?");
            $stmt->bind_param("ssssssi", $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad, $id);
            return $stmt->execute() ? ['actualizar' => true] : ['error' => $stmt->error];
        } else {
            // Si no hay ID, se inserta un nuevo técnico
            $stmt = $this->con->prepare("INSERT INTO datostecnico 
                                         (Cedula, Nombres, Apellidos, Telefono, Nombre_Tecnico, Especialidad, Activo) 
                                         VALUES (?, ?, ?, ?, ?, ?, 1)");
            $stmt->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $nombre_completo, $especialidad); 
            return $stmt->execute() ? ['guardar' => true] : ['error' => $stmt->error];
        }
    }

    // Método para eliminar lógicamente un técnico (no se elimina físicamente de la base de datos)
    public function eliminar($id) {
        $stmt = $this->con->prepare("UPDATE datostecnico SET Activo = 0 WHERE Id_Tecnico = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Método para obtener todos los técnicos activos
    public function obtenerTecnico() {
        $stmt = $this->con->prepare("SELECT * FROM datostecnico WHERE Activo = 1");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Método para verificar si una cédula ya existe en otro técnico (útil para evitar duplicados)
    public function cedulaExiste($cedula, $id = null) {
        if ($id) {
            // Verifica si la cédula existe en otro técnico distinto al actual (en caso de edición)
            $stmt = $this->con->prepare("SELECT 1 FROM datostecnico WHERE Cedula = ? AND Id_Tecnico != ? AND Activo = 1");
            $stmt->bind_param("si", $cedula, $id);
        } else {
            // Verifica si la cédula ya existe en cualquier técnico activo
            $stmt = $this->con->prepare("SELECT 1 FROM datostecnico WHERE Cedula = ? AND Activo = 1");
            $stmt->bind_param("s", $cedula);
        }
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}
?>
