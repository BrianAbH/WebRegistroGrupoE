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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/fda2d00f8d.js" crossorigin="anonymous"></script>
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
            <h2>Ingrese los datos del cliente</h2>
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
                <input type="submit" name="guardar" class="menu-datos-contenedor" >
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
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
                <div class="scroll-wrapper">
                    <table class="table">
                        <tbody>
                            
                            <?php foreach ($resultado as $row) {
                            echo ' 
                                <tr>
                                    <td>' . $row["Id_Cliente"] . '</td>
                                    <td>' . $row["Cedula"] . '</td>
                                    <td>' . $row["Nombres"] . '</td>
                                    <td>' . $row["Apellidos"] . '</td>
                                    <td>' . $row["Telefono"] . '</td>
                                    <td>' . $row["Direccion"] . '</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            ';
                            } ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
   
    <!-- Footer -->
  <footer class="bg-white">
    <div class="container py-5">
      <div class="row py-4">
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0"><img src="img/logo.png" alt="" width="180" class="mb-3">
          <ul class="list-inline mt-4">
            <li class="list-inline-item"><a href="#" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="vimeo"><i class="fa fa-vimeo"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Grupo</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><a href="#" class="text-muted">Carranza</a></li>
            <li class="mb-2"><a href="#" class="text-muted">Carrion</a></li>
            <li class="mb-2"><a href="#" class="text-muted">Chiriguaya</a></li>
            <li class="mb-2"><a href="#" class="text-muted">Hidalgo</a></li>
            <li class="mb-2"><a href="#" class="text-muted">Morales</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Company</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><a href="Login.php" class="text-muted">Login</a></li>
            <li class="mb-2"><a href="DatosCliente.php" class="text-muted">Datos del Cliente</a></li>
            <li class="mb-2"><a href="DatosTecnico.php" class="text-muted">Datos del Tecnio</a></li>
            <li class="mb-2"><a href="#" class="text-muted">Datos del Telefono</a></li>
            <li class="mb-2"><a href="#" class="text-muted">Registro del Mantenimiento</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 mb-lg-0">
          <h6 class="text-uppercase font-weight-bold mb-4">Newsletter</h6>
          <p class="text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque temporibus.</p>
          <div class="p-1 rounded border">
            <div class="input-group">
              <input type="email" placeholder="Enter your email address" aria-describedby="button-addon1" class="form-control border-0 shadow-0">
              <div class="input-group-append">
                <button id="button-addon1" type="submit" class="btn btn-link"><i class="fa fa-paper-plane"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Copyrights -->
    <div class="bg-light py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-2">© 2025 All rights reserved.</p>
      </div>
    </div>
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
 

