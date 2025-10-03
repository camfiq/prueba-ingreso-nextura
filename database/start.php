<?php
$config = require __DIR__ . '/../config.php';


/** EJECUTAR PARA LANZAR LA APLICACIÓN */

/** Crear base de datos si no existe por fines prácticos */
$conexion = new PDO("mysql:host={$config['db']['host']}", "{$config['db']['user']}", "{$config['db']['pass']}");

$conexion->query('DROP DATABASE prueba_nexura');

$conexion->exec("CREATE DATABASE IF NOT EXISTS prueba_nexura");
$conexion->exec("USE prueba_nexura");


/** Crear tabla areas */
$conexion->query('
        CREATE TABLE areas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL
        );
');

$conexion->query('
        CREATE TABLE roles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL
        );
');


$conexion->query('
       CREATE TABLE empleados (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            sexo CHAR(1) NOT NULL,
            area_id INT NOT NULL,
            boletin INT(11) DEFAULT 0,
            descripcion TEXT NOT NULL,
            FOREIGN KEY (area_id) REFERENCES areas(id) ON DELETE CASCADE
        );
');

$conexion->query('
        CREATE TABLE empleado_rol (
            empleado_id INT NOT NULL,
            rol_id INT NOT NULL,
            PRIMARY KEY (empleado_id, rol_id),
            FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE,
            FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE
        );
');


/** Ingresar datos Default */
$conexion->query("
    INSERT INTO roles (nombre) VALUES
    ('Profesional de proyectos'),
    ('Gerente estratégico'),
    ('Auxiliar administrativo');
");

$conexion->query("
INSERT INTO areas (nombre) VALUES  
('Administración'),
('Ventas'),
('Producción'),
('Calidad');
");

$conexion->query("
INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion) VALUES
('Camilo Fique', 'camilo.fique@gmail.com', 'M', 1, 1, 'Empleado del área de Administración'),
('Andres Cartagena', 'andres.cartagena@hotmail.com', 'M', 2, 0, 'Empleado del área de Ventas'),
('Pepito perez', 'pepito.perez@gmail.com', 'M', 3, 1, 'Empleado del área de Producción');
");

echo "EJECUCIÓN EXITOSA";

/** */
