<?php



class EmpleadoController
{
    private $empleadoModel;
    private $rolModel;
    private $areaModel;
    private $empleadoRolModel;

    public function __construct($conexion)
    {
        $this->empleadoModel = new Empleado($conexion);
        $this->rolModel = new Rol($conexion);
        $this->areaModel = new Area($conexion);
        $this->empleadoRolModel = new EmpleadoRol($conexion);
    }

    // Listar empleados
    public function index()
    {
        $empleados = $this->empleadoModel->allWithArea();
        require __DIR__ . '/../views/empleados/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {

        $areas = $this->areaModel->all();
        $roles = $this->rolModel->all();
        $mensajeError = $_GET['error'] ?? '';
        require __DIR__ . '/../views/empleados/create.php';
    }

    // Guardar nuevo empleado
    public function store($post)
    {
        if (empty($post['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u', trim($post['nombre']))) {
            return ['resultado' => false, 'error' => "El nombre no tiene el formato válido"];
        }

        if (empty($post['email']) || !filter_var(trim($post['email']), FILTER_VALIDATE_EMAIL)) {
            return ['resultado' => false, 'error' => "El correo electrónico no es válido"];
        }

        if (empty($post['sexo']) || !in_array($post['sexo'], ['M', 'F'])) {
            return ['resultado' => false, 'error' => "Debe seleccionar un sexo válido"];
        }

        if (empty($post['area_id']) || !is_numeric($post['area_id'])) {
            return ['resultado' => false, 'error' => "Debe seleccionar un área válida"];
        }

        if (empty($post['descripcion']) || strlen(trim($post['descripcion'])) < 1) {
            return ['resultado' => false, 'error' => "Debe indicarse la descripción"];
        }

        if (empty($post['roles']) || !is_array($post['roles'])) {
            return ['resultado' => false, 'error' => "Debe seleccionar al menos un rol"];
        }

        $area = $this->areaModel->find($post['area_id']);
        if (!$area) {
            return ['resultado' => false, 'error' => "El área seleccionada no existe"];
        }

        foreach ($post['roles'] as $rol_id) {
            if (!is_numeric($rol_id) || !$this->rolModel->find($rol_id)) {
                return ['resultado' => false, 'error' => "Uno o más roles seleccionados no existen"];
            }
        }

        $this->empleadoModel->create($post);
        return ['resultado' => true, 'error' => "Empleado creado"];
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $empleado = $this->empleadoModel->find($id);
        require __DIR__ . '/../views/empleados/edit.php';
    }

    // Actualizar empleado
    public function update($post)
    {
        //$this->empleadoModel->update($id, $data);
        header("Location: index.php?controller=empleado&action=index&msg=Empleado actualizado");
        exit;
    }

    // Eliminar empleado
    public function delete($post)
    {


        if (empty($post['idEmpleado']) || !is_numeric($post['idEmpleado'])) {
            return  ['resultado' => false, 'error' => "No se envió un empleado válido"];
        }

        $empleado = $this->empleadoModel->find($post['idEmpleado']);

        if (!$empleado) {
            return  ['resultado' => false, 'error' => "No existe el empleado indicado"];
        }

        $this->empleadoModel->delete($empleado['id']);
        return  ['resultado' => true, 'error' => "Se eliminó correctamente el empleado"];
    }
}
