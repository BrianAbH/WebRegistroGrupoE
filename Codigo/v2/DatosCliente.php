<?php
include("class/ingresarCliente.php") ;
include("class/mostrarDatosCliente.php");
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
  <?php include('php/menu.php') ?>
  <!-- Contenedor de los títulos de bienvenida o encabezado de sección -->
  <div class="contenedor-titulo">
    <div class="titulo">
      <h2>Ingrese los datos del Cliente</h2>
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
            <!-- Campo para ingresar la cedula del cliente -->
            <div class="form-content">
              <input type="hidden" name="id" id="id">
              <label for="cedula" class="form-label">Cedula</label>
              <input type="text" class="form-input" name="cedula" id="cedula" pattern="\d+" required>
            </div>
            <!-- Campo para ingresar el nombre del cliente -->
            <div class="form-content">
              <label for="nombre" class="form-label">Nombres</label>
              <input type="text" class="form-input" name="nombre" id="nombre" pattern="[A-Za-z]+" required>
            </div>
        </div>

        <!-- Segundo grupo de campos del formulario -->
        <div class="form-group">
          <!-- Campo para ingresar los apellidos del cliente -->
          <div class="form-content">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-input" name="apellido" id="apellido" pattern="[A-Za-z]+" required>
          </div>
          <!-- Campo para ingresar el teléfono del cliente -->
          <div class="form-content">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" class="form-input" name="telefono" id="telefono" pattern="\d+" required>
          </div>
        </div>

        <!-- Tercer grupo de campos del formulario -->
        <div class="form-group">
          <!-- Campo para ingresar la dirección del cliente -->
          <div class="form-content">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-input" name="direccion" id="direccion" required>
          </div>
        </div>
        <input type="submit" name="guardar" class="btn-Guardar" value="Guardar">
      </form>
    </div>
    
    <!-- Contenedor que agrupa la informacion de la tabla -->
    <div class="contenedor-tabla">
      <h1>Clientes Ingresados</h1>
      <hr>
      <!-- Encabezado fijo -->
      <table class="table table-dark">
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

      <!-- Tabla scrolleable -->
      <div class="scroll-wrapper">
          <table class="table">
              <tbody>
                  <?php foreach ($resultado as $row): ?>
                      <tr>
                          <td><?= $row["Id_Cliente"] ?></td>
                          <td><?= $row["Cedula"] ?></td>
                          <td><?= $row["Nombres"] ?></td>
                          <td><?= $row["Apellidos"] ?></td>
                          <td><?= $row["Telefono"] ?></td>
                          <td><?= $row["Direccion"] ?></td>
                          <td>
                              <!-- BOTÓN EDITAR -->
                              <button 
                                  type="button" 
                                  class="btn btn-outline-warning" 
                                  onclick="llenarFormulario(
                                      '<?= $row["Id_Cliente"] ?>',
                                      '<?= $row["Cedula"] ?>',
                                      '<?= $row["Nombres"] ?>',
                                      '<?= $row["Apellidos"] ?>',
                                      '<?= $row["Telefono"] ?>',
                                      '<?= $row["Direccion"] ?>'
                                  )">
                                  <i class="fa-solid fa-pen-to-square"></i>
                              </button>
                              <!-- BOTÓN ELIMINAR -->
                              <form action="" method="POST" style="display:inline;">
                                  <input type="hidden" name="id" value="<?= $row["Id_Cliente"] ?>">
                                  <button type="submit" name="eliminar" value="1" class="btn btn-outline-danger" onclick="return confirm('¿Seguro que quieres eliminar este cliente?')">
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
      function llenarFormulario(id, cedula, nombre, apellido, telefono, direccion) {
      document.getElementById('id').value = id;
      document.getElementById('cedula').value = cedula;
      document.getElementById('nombre').value = nombre;
      document.getElementById('apellido').value = apellido;
      document.getElementById('telefono').value = telefono;
      document.getElementById('direccion').value = direccion;}
  </script>
  
  <?php include'php/footer.php' ?>
</body>
</html>


 

