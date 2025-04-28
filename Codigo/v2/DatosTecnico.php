<?php
include("class/ingresarTecnico.php") ;
include("class/mostrarDatosTecnico.php");
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
      <h2>Ingrese los datos del Tecnico</h2>
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
          <!-- Campo para ingresar el nombre del tecnico -->
          <div class="form-content">
            <input type="hidden" name="id" id="id">
            <label for="cedula" class="form-label">Cedula</label>
            <input type="text" class="form-input" name="cedula" id="cedula" pattern="\d+" required>
          </div>
          <!-- Campo para ingresar el nombre del tecnico -->
          <div class="form-content">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" class="form-input" name="nombre" id="nombre" pattern="[A-Za-z]+" required>
          </div>
        </div>

        <!-- Segundo grupo de campos del formulario -->
        <div class="form-group">
          <!-- Campo para ingresar los apellidos del tecnico -->
          <div class="form-content">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-input" name="apellido" id="apellido" pattern="[A-Za-z]+" required>
          </div>
          <!-- Campo para ingresar el teléfono del tecnico -->
          <div class="form-content">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" class="form-input" name="telefono" id="telefono" pattern="\d+" required>
          </div>
        </div>

        <!-- Tercer grupo de campos del formulario -->
        <div class="form-group-select">
          <!-- Campo para ingresar la especialidad del tecnico -->
          <div class="form-content-select">
                <label for="especialidad" class="form-label">Especialidad</label>
                <select class="select" id="especialidad" name="especialidad" required>
                    <option value="">-- Selecciona una Especialidad --</option>
                    <option value="En Telefono Android">En Telefono Android</option>
                    <option value="En Telefono Iphone">En Telefono Iphone</option>
                    <option value="En Telefono Xiaomi">En Telefono Xiaomi</option>
                    <option value="En Telefono Huawei">En Telefono Huawei</option>
                </select>
          </div>
        </div>
        <input type="submit" name="guardar" class="btn-Guardar" value="Guardar">
      </form>
    </div>

    <!-- Contenedor que agrupa la informacion de la tabla -->
    <div class="contenedor-tabla">
      <h1>Tecnicos Ingresados</h1>
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
            <th>Especialidad</th>
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
                <td><?= $row["Id_Tecnico"] ?></td>
                <td><?= $row["Cedula"] ?></td>
                <td><?= $row["Nombres"] ?></td>
                <td><?= $row["Apellidos"] ?></td>
                <td><?= $row["Telefono"] ?></td>
                <td><?= $row["Especialidad"] ?></td>
                <td>
                  <!-- BOTÓN EDITAR -->
                  <button 
                    type="button" class="btn btn-outline-warning" onclick="llenarFormulario(
                      '<?= $row["Id_Tecnico"] ?>',
                      '<?= $row["Cedula"] ?>',
                      '<?= $row["Nombres"] ?>',
                      '<?= $row["Apellidos"] ?>',
                      '<?= $row["Telefono"] ?>',
                      '<?= $row["Especialidad"] ?>'
                    )"><i class="fa-solid fa-pen-to-square"></i></button>
                    <!-- BOTÓN ELIMINAR -->
                    <form action="" method="POST" style="display:inline;">
                      <input type="hidden" name="id" value="<?= $row["Id_Tecnico"] ?>">
                      <button type="submit" name="eliminar" value="1" class="btn btn-outline-danger" onclick="return confirm('¿Seguro que quieres eliminar este Tecnico?')">
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
      function llenarFormulario(id, cedula, nombre, apellido, telefono, especialidad) {
        document.getElementById('id').value = id;
        document.getElementById('cedula').value = cedula;
        document.getElementById('nombre').value = nombre;
        document.getElementById('apellido').value = apellido;
        document.getElementById('telefono').value = telefono;
        var select = document.getElementById('especialidad');
        // Buscar la opción que coincida
        for (var i = 0; i < select.options.length; i++) {
          if (select.options[i].value === especialidad) {
            select.selectedIndex = i;
            break;
          }
        }
      }
  </script>

  <?php include('php/footer.php') ?>
</body>
</html>
