<?php
require_once __DIR__ . '/../database/conexion.php';
require_once __DIR__ . '/../app/models/empleado.php';
require_once __DIR__ . '/../app/models/area.php';
require_once __DIR__ . '/../app/models/rol.php';
require_once __DIR__ . '/../app/models/empleadoRol.php';


require_once __DIR__ . '/../app/controllers/EmpleadoController.php';

$conexion = Conexion::getInstance();
$controller = new EmpleadoController($conexion);

// Acción según parámetro
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode($controller->store($_POST));
        }
        break;
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store($_POST);
            echo json_encode($controller->edit($_POST));
        }
        break;
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update($_POST);
        }
        break;
    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode($controller->delete($_POST));
        }
        break;
    default:
        die("Acción no válida");
}
