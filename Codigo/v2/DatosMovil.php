<?php
include("class/mostrarDatosMovil.php");
include("class/ingresarMovil.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="css/DatosMovil.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/fda2d00f8d.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('php/menu.php') ?>
    <!-- Contenedor de los títulos de bienvenida o encabezado de sección -->
    <div class="contenedor-titulo">
        <div class="titulo">
        <h2>Ingrese los datos del Telefono</h2>
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
                        <?php while ($fila = $resultadoCliente->fetch_assoc()) { ?>
                            <option value="<?php echo $fila['Id_Cliente'] ?>"><?php echo $fila['Nombres'] ?> <?php echo $fila['Apellidos'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Campo para ingresar el tipo de dispositivo -->
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
            <!-- Campo para ingresar el añp deñdispositivo -->
            <div class="form-content">
                <label for="anio" class="form-label">Año</label>
                <input type="text" class="form-input" name="anio" id="anio" pattern="\d+" required>
            </div>
            </div>

            <input type="submit" name="guardar" class="btn-Guardar" value="Guardar">
        </form>
        </div>
        
        <!-- Contenedor que agrupa la informacion de la tabla -->
        <div class="contenedor-tabla">
            <h1>Dispositivos Ingresados</h1>
            <hr>
            <!-- Encabezado fijo -->
            <table class="table table-dark">
                <thead>
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
            </table>

            <!-- Tabla scrolleable -->
            <div class="scroll-wrapper">
                <table class="table">
                    <tbody>
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

    <script>
        function llenarFormulario(id, nombre_completo, tipo, marca, modelo, año) {
        document.getElementById('id').value = id;
        document.getElementById('cliente').value = nombre_completo;
        document.getElementById('tipo').value = tipo;
        document.getElementById('marca').value = marca;
        document.getElementById('modelo').value = modelo;
        document.getElementById('anio').value = año;
        
      }
    </script>
    <?php include'php/footer.php' ?>
</html>