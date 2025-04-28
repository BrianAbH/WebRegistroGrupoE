<?php
// Incluir los archivos PHP necesarios para mostrar y procesar los datos de los móviles
include("../model/mostrarDatos/mostrarDatosMovil.php"); // Muestra los datos de los móviles desde la base de datos
include("../model/ingresarDatos/ingresarMovil.php"); // Procesa el formulario para ingresar nuevos móviles
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/DatosMovil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fda2d00f8d.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Incluimos el menú de navegación desde un archivo PHP -->
    <?php include('../controllers/helpers/menu.php') ?>
    <!-- Contenedor de los títulos de bienvenida o encabezado de sección -->
    <div class="contenedor-titulo">
        <div class="titulo">
        <h2>Ingrese los datos del Dispositivos</h2>
        <h1>Proyecto para el Registro de Reparaciones de Celulares</h1>
        </div>
    </div>

    <!-- Contenedor que agrupa todos los elementos del formulario y a la tabla -->
    <div class="contenedor-datos">
        <!-- Contenedor del formulario -->
        <div class="contenedor-form">
            <form action="" method="POST">
                <!-- Primer grupo de campos del formulario -->
                <div class="form-group">
                    <!-- Campo para seleccionar al cliente -->
                    <div class="form-content">
                        <input type="hidden" name="id" id="id">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select class="select" id="cliente" name="cliente" required>
                            <option value="">--Seleccione el cliente--</option>
                            <!-- Utilizamos un ciclo PHP para mostrar todos los clientes disponibles -->
                            <?php while ($fila = $resultadoCliente->fetch_assoc()) { ?>
                                <option value="<?php echo $fila['Id_Cliente'] ?>"><?php echo $fila['Nombre_Completo'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Campo para seleccionar el tipo de dispositivo -->
                    <div class="form-content">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="select" id="tipo" name="tipo" required>
                            <option value="">--Seleccione el tipo de dispositivo--</option>
                            <option value="Smartphone">Smartphone</option>
                            <option value="Tablet">Tablet</option>
                        </select>
                    </div>
                </div>

                <!-- Segundo grupo de campos del formulario -->
                <div class="form-group">
                    <!-- Campo para ingresar la marca del dispositivo -->
                    <div class="form-content">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-input" name="marca" id="marca" pattern="[A-Za-z]+" required>
                    </div>
                    <!-- Campo para ingresar el modelo del dispositivo -->
                    <div class="form-content">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-input" name="modelo" id="modelo" required>
                    </div>
                    
                </div>

                <!-- Tercer grupo de campos del formulario -->
                <div class="form-group">
                    <!-- Campo para ingresar el año del dispositivo -->
                    <div class="form-content">
                        <label for="anio" class="form-label">Año</label>
                        <input type="text" class="form-input" name="anio" id="anio" pattern="\d{4,4}" required>
                    </div>
                </div>

                <!-- Botón para enviar el formulario y guardar los datos -->
                <input type="submit" name="guardar" class="btn-Guardar" value="Guardar">
            </form>
        </div>

        <!-- Contenedor que agrupa la informacion de la tabla -->
        <div class="contenedor-tabla">
            <h1>Dispositivos Ingresados</h1>
            <hr>
            <!-- Tabla scrolleable -->
            <div class="scroll-wrapper">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Utilizamos un ciclo PHP para mostrar todos los dispositivos en la base de datos -->
                        <?php foreach ($resultadoMovil as $row): ?>
                            <tr>
                                <td><?= $row["Id_Movil"] ?></td>
                                <td><?= $row["Nombre_Completo"] ?></td>
                                <td><?= $row["Tipo"] ?></td>
                                <td><?= $row["Marca"] ?></td>
                                <td><?= $row["Modelo"] ?></td>
                                <td><?= $row["Año"] ?></td>
                                <td>
                                    <!-- BOTÓN EDITAR -->
                                    <!-- Botón para editar el dispositivo, pasando los datos correspondientes -->
                                    <button type="button" class="btn btn-outline-warning" 
                                        onclick="llenarFormulario(
                                            '<?= $row["Id_Movil"] ?>',
                                            '<?= $row["Id_Cliente"] ?>',
                                            '<?= $row["Tipo"] ?>',
                                            '<?= $row["Marca"] ?>',
                                            '<?= $row["Modelo"] ?>',
                                            '<?= $row["Año"] ?>',
                                        )">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <!-- BOTÓN ELIMINAR -->
                                    <!-- Botón para eliminar el dispositivo, con confirmación previa -->
                                    <form action="" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row["Id_Movil"] ?>">
                                        <button type="submit" name="eliminar" value="1" class="btn btn-outline-danger" 
                                        onclick="return confirm('¿Seguro que quieres eliminar este dispositivo?')">
                                        <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Incluimos el archivo JavaScript para funcionalidad adicional -->
    <script src="../js/datosMovil.js"></script>
    
    <!-- Incluimos el pie de página -->
    <?php include('footer.php') ?>
</html>