<?php
include("config/ingresarCliente.php") ;
include("config/mostrarDatos.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="css/index.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <!-- Barra de navegación principal -->
    <nav class="menu">
        <h1>G2 RepairTrack</h1>
    <!-- Enlaces de navegación a distintas secciones -->
        <a href="DatosCliente.php">Datos del Cliente</a>
        <a href="DatosTecnico.php">Datos del Tecnico</a> 
        <a href="">Datos del Telefono</a> 
        <a href="">Mantenimientos</a>
    </nav>

    <!-- Contenedor de los títulos de bienvenida o encabezado de sección -->
    <div class="contenedor-titulo">
        <div class="titulo">
            <h2>Ingrese los datos del Tecnico</h2>
            <h1>Proyecto para el registro de Mantenimiento de celulares</h1>
        </div>
    </div>
    
    <!-- Contenedor que agrupa todos los elementos del formulario y el menú de operaciones -->
    <div class="contenedor-datos">
        <!-- Contenedor del formulario -->
        <div class="contenedor-form">
            <form action="" method="POST">
                <div class="form-group">
                    <!-- Campo para ingresar la cedula del cliente -->
                    <div class="form-content">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-input" name="cedula" id="cedula" required>
                    </div>
                    <!-- Campo para ingresar el nombre del cliente -->
                    <div class="form-content">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-input" name="nombre" id="nombre" required>
                    </div>
                </div>

                <!-- Segundo grupo de campos del formulario -->
                <div class="form-group">
                    <!-- Campo para ingresar los apellidos del cliente -->
                    <div class="form-content">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-input" name="apellido" id="apellido" required>
                    </div>
                    <!-- Campo para ingresar el teléfono del cliente -->
                    <div class="form-content">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-input" name="telefono" id="telefono" required>
                    </div>
                </div>

                <div class="form-group">
                    <!-- Campo para ingresar la dirección del cliente -->
                    <div class="form-content">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-input" name="direccion" id="direccion" required>
                    </div>
                </div>
                <div class="menu-datos-contenedor">
                    <input type="submit" name="guardar">
                </div>
            </form>
        </div>

        <!-- Contenedor que agrupa la informacion de la tabla -->
        <div class="contenedor-tabla">
            <h1>Clientes Ingresados</h1>
            <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                </table>
                <div class="scroll-wrapper">
                    <table class="table">
                        <tbody>
                            <?php foreach ($resultado as $row) {
                            echo "
                                <tr>
                                <td>" . $row["Id"] . "</td>
                                <td>" . $row["Cedula"] . "</td>
                                <td>" . $row["Nombres"] . "</td>
                                <td>" . $row["Apellidos"] . "</td>
                                <td>" . $row["Telefono"] . "</td>
                                <td>" . $row["Direccion"] . "</td>
                                </tr>
                            ";
                            } ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
   
    <footer>  
    </footer>
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
</body>
</html>
 

