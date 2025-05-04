<?php
// Se incluyen los archivos necesarios:
// - Cliente.php contiene la clase Cliente con sus métodos.
// - database.php contiene la clase Database para la conexión a la base de datos.
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../../config/database.php';

// Se crea una nueva instancia de la base de datos y se obtiene la conexión.
$db = new Database();
$con = $db->conectar();

// Se crea una instancia del modelo Cliente, pasándole la conexión como parámetro.
$cliente = new Cliente($con);

// Se verifica si la solicitud es de tipo POST (es decir, si se envió un formulario).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Si se presionó el botón 'guardar' en el formulario
    if (isset($_POST['guardar'])) {
        // Se llama al método guardar del modelo Cliente con los datos del formulario.
        $resultado = $cliente->guardar($_POST);

        // Si hubo un error durante el guardado, se guarda en la sesión para mostrarlo al usuario.
        if (isset($resultado['error'])) {
            $_SESSION['error'] = $resultado['error'];
        }

        // Si el cliente fue actualizado correctamente, se guarda un mensaje de éxito en la sesión.
        if (isset($resultado['actualizar'])) {
            $_SESSION['exito'] = '<div class="alert alert-primary">Cliente Actualizado correctamente.</div>';
        }

        // Si el cliente fue guardado (creado) correctamente, se guarda otro mensaje de éxito en la sesión.
        if (isset($resultado['guardar'])) {
            $_SESSION['exito'] = '<div class="alert alert-success">Cliente Guardado correctamente.</div>';
        }

    // Si se presionó el botón 'eliminar' en el formulario
    } elseif (isset($_POST['eliminar'])) {
        // Se llama al método eliminar del modelo Cliente con el ID proporcionado.
        $cliente->eliminar($_POST['id']);

        // Se guarda un mensaje en la sesión indicando que el cliente fue eliminado.
        $_SESSION['exito'] = '<div class="alert alert-danger">Cliente Eliminado correctamente.</div>';
    }

    // Luego de procesar el formulario, se redirige a la vista VistaCliente.php para evitar reenvíos al recargar.
    header("Location: VistaCliente.php"); 
    exit();
}

// Si no se envió un formulario POST, se obtienen todos los clientes para mostrarlos en la vista.
$resultado = $cliente->obtenerClientes();

?>
