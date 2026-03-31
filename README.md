# G2 RepairTrack

## Descripción del Proyecto

**G2 RepairTrack** es una aplicación web desarrollada con **PHP** diseñada para gestionar y registrar servicios de reparación de dispositivos. El sistema permite que técnicos registren clientes, dispositivos, servicios de reparación y realicen un seguimiento completo del proceso de reparación.

## Características Principales

- **Gestión de Clientes**: Registro, actualización y búsqueda de clientes con validación de cédula única
- **Registro de Dispositivos**: Clasificación de equipos a reparar con información detallada
- **Control de Reparaciones**: Seguimiento de servicios de reparación en tiempo real
- **Gestión de Técnicos**: Administración de personal técnico disponible
- **Autenticación**: Sistema de login seguro para acceder a la plataforma
- **Interfaz Responsiva**: Diseño adaptable con Bootstrap 4

## Estructura del Proyecto

```
WebRegistroGrupoE/
├── App/
│   ├── Codigo/
│   │   ├── index.php                 # Punto de entrada principal
│   │   ├── Config/
│   │   │   └── database.php          # Configuración de conexión a BD
│   │   ├── controllers/              # Controladores (lógica de negocio)
│   │   │   ├── ClienteController.php
│   │   │   ├── DispositivoController.php
│   │   │   ├── ReparacionController.php
│   │   │   └── TecnicoController.php
│   │   ├── models/                   # Modelos de datos
│   │   │   ├── Cliente.php
│   │   │   ├── ClienteException.php
│   │   │   ├── Dispositivo.php
│   │   │   ├── Reparacion.php
│   │   │   └── Tecnico.php
│   │   ├── views/                    # Interfaz de usuario
│   │   │   ├── vistaCliente.php
│   │   │   ├── vistaDispositivo.php
│   │   │   ├── vistaReparaciones.php
│   │   │   ├── vistaTecnico.php
│   │   │   ├── css/                  # Estilos personalizados
│   │   │   ├── helpers/              # Funciones auxiliares (login, menu, footer)
│   │   │   ├── img/                  # Recursos gráficos
│   │   │   └── js/                   # Scripts del lado del cliente
│   │   └── test/                     # Pruebas unitarias
│   └── Dase de datos/                # Scripts SQL
│       ├── datoscliente.sql
│       ├── datosdispositivos.sql
│       ├── datostecnico.sql
│       └── reparaciones.sql
├── Docs/                             # Documentación
│   └── Bitacoras/
└── README.md
```

## Requisitos Previos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache, Nginx, etc.)
- Bootstrap 4
- jQuery 3.2

## Instalación

1. **Clonar o descargar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd WebRegistroGrupoE
   ```

2. **Configurar la base de datos**
   - Crear una base de datos en MySQL
   - Importar los scripts SQL de `App/Dase de datos/`:
     - `datoscliente.sql`
     - `datosdispositivos.sql`
     - `datostecnico.sql`
     - `reparaciones.sql`

3. **Configurar la conexión a BD**
   - Editar `App/Codigo/Config/database.php`
   - Ajustar los parámetros de conexión (host, usuario, contraseña, nombre de BD)

4. **Colocar la aplicación en el servidor web**
   - Copiar la carpeta `App/Codigo/` al directorio raíz del servidor web

## Uso

1. Acceder a la aplicación en el navegador
2. Ingresar credenciales de usuario y contraseña en el formulario de login
3. Navegar por el menú principal para:
   - Gestionar clientes
   - Registrar dispositivos
   - Crear órdenes de reparación
   - Administrar técnicos

## Módulos Principales

### Cliente
Gestión de información de clientes que traen equipos a reparar:
- Registro de nuevos clientes
- Edición de datos personales
- Validación de cédula única
- Búsqueda y filtrado

### Dispositivo
Registro de equipos a reparar:
- Clasificación por tipo de dispositivo
- Descripción técnica
- Estado del equipo
- Asociación con cliente

### Reparación
Seguimiento del proceso de reparación:
- Creación de órdenes de servicio
- Asignación a técnicos
- Registro de estado actual
- Histórico de reparaciones

### Técnico
Administración del personal técnico:
- Registro de técnicos disponibles
- Información de contacto
- Especialidades
- Asignación de trabajos

## Testing

El proyecto incluye pruebas unitarias en la carpeta `App/Codigo/test/`:
- `clienteTest.php`
- `dispositivoTest.php`
- `reparacionTest.php`
- `tecnicoTest.php`

## Tecnologías Utilizadas

- **Backend**: PHP (Programación Orientada a Objetos)
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 4, jQuery
- **Patrón de Diseño**: MVC (Modelo-Vista-Controlador)

## Desarrolladores

Grupo E

## Licencia

Este proyecto es de uso interno del grupo E.