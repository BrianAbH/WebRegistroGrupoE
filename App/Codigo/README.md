# WebRegistroGrupoE

## Descripción
Sistema de registro y seguimiento de reparaciones para Grupo E (G2 RepairTrack). Permite gestionar clientes, dispositivos, técnicos y reparaciones.

## Tecnologías Utilizadas

### Backend
- **PHP**: Lenguaje de programación principal para la lógica del servidor. Se utiliza un patrón MVC personalizado sin frameworks externos.
- **MySQL**: Sistema de gestión de bases de datos relacional para almacenar la información de clientes, dispositivos, reparaciones y técnicos.

### Frontend
- **HTML**: Estructura de las páginas web.
- **CSS**: Estilos para la presentación visual.
- **JavaScript**: Interactividad del lado del cliente.

### Librerías y Frameworks
- **Bootstrap 4.0.0**: Framework CSS para diseño responsivo y componentes de interfaz de usuario.
- **jQuery 3.2.1**: Librería JavaScript para simplificar la manipulación del DOM y eventos.
- **Popper.js**: Librería para posicionamiento de elementos (usada por Bootstrap para tooltips y popovers).

### Arquitectura
- **Patrón MVC**: Modelo-Vista-Controlador implementado de manera personalizada.
  - **Modelos**: Gestionan la lógica de datos y la interacción con la base de datos.
  - **Vistas**: Plantillas HTML/PHP para la presentación.
  - **Controladores**: Manejan las solicitudes del usuario y coordinan entre modelos y vistas.

### Otros
- **Servidor Web**: Compatible con servidores que soporten PHP y MySQL (ej. Apache, Nginx).
- **Sesiones PHP**: Para gestión de autenticación y estado del usuario.

## Estructura del Proyecto
- `index.php`: Punto de entrada y página de login.
- `Config/database.php`: Configuración de conexión a la base de datos.
- `controllers/`: Controladores para cada entidad (Cliente, Dispositivo, Reparación, Técnico).
- `models/`: Modelos de datos y excepciones personalizadas.
- `views/`: Vistas HTML/PHP y archivos estáticos (CSS, JS, imágenes).
- `test/`: Archivos de prueba para las funcionalidades.

## Requisitos
- PHP 7.0 o superior
- MySQL 5.7 o superior
- Servidor web con soporte para PHP

## Instalación
1. Configurar la base de datos MySQL con el nombre "proyecto".
2. Actualizar las credenciales en `Config/database.php` si es necesario.
3. Colocar los archivos en el directorio raíz del servidor web.
4. Acceder a `index.php` para iniciar sesión.