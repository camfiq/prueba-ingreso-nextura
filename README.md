# NEXURA - Prueba Técnica en PHP

Este proyecto es una aplicación en PHP desarrollada como prueba técnica. Está pensada para ejecutarse en entornos locales como **XAMPP** o **Laragon**.

## Instrucciones de inicio

1. **Generar la base de datos**  
   Ejecutar el archivo:

   ```
   /database/start.php
   ```

   Este script creará la base de datos y las tablas necesarias automáticamente.

2. **Configuración de conexión a la base de datos**  
   Por defecto, la aplicación asume las siguientes credenciales:

   - Usuario: `root`  
   - Contraseña: (vacía)

   Si tu entorno utiliza otra configuración, puedes modificarla en el archivo:

   ```
   /config.php
   ```

3. **Ejecutar el proyecto**  
   Una vez creada la base de datos, el proyecto se puede abrir desde el archivo principal:

   ```
   index.php (en la raíz del proyecto)
   ```

   Ejemplo en navegador:  
   ```
   http://localhost/nexura-prueba/index.php
   ```

## Estructura del proyecto

- **/app**  
  Contiene la lógica principal de la aplicación:
  - `controllers/` → Controladores de cada módulo (por ejemplo, `EmpleadoController.php`).
  - `models/` → Modelos que manejan la lógica de negocio y acceso a datos (`Empleado.php`, `Rol.php`, etc.).
  - `views/` → Vistas organizadas en carpetas por módulo. Incluye también un layout común (`header.php`, `footer.php`).

- **/database**  
  Incluye lo necesario para inicializar la base de datos:
  - `start.php` → Script PHP para crear la base de datos de forma automática.
  - `prueba_nexura.sql` → Script SQL de respaldo (solo debería usarse si por alguna razón falla `start.php`).

- **/public**  
  Contiene los recursos públicos de la aplicación:
  - `index.php` → Punto de entrada principal del sistema.
  - `css/` → Hojas de estilo.
  - `js/` → Scripts organizados en módulos.
  - `plugins/` → Librerías externas (como Bootstrap).

- **/config.php**  
  Archivo de configuración general, principalmente para las credenciales de conexión a la base de datos.

## Nota

En caso de que el archivo `start.php` no funcione en tu entorno, puedes utilizar el script `prueba_nexura.sql` ubicado en la carpeta `/database` para importar la base de datos manualmente.
