<?php
class EmpleadoRol
{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function all()
    {
        $stmt = $this->conexion->query("SELECT * FROM empleado_rol");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRolesByEmpleadoId($empleadoID)
    {
        $stmt = $this->conexion->prepare("SELECT rol_id FROM empleado_rol WHERE empleado_id = ?");
        $stmt->execute([$empleadoID]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function find($empleadoID, $rolID)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM empleado_rol WHERE empleado_id=? AND rol_id=?");
        $stmt->execute([$empleadoID, $rolID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conexion->prepare("INSERT INTO empleado_rol (empleado_id,rol_id) VALUES (?,?)");
        return $stmt->execute([
            $data['empleado_id'],
            $data['rol_id'],
        ]);
    }

    /** Debido a la relación muchos a muchos no tiene sentido tener una función update */
    public function update($data) {}

    public function delete($empleadoID, $rolID)
    {
        $stmt = $this->conexion->prepare("DELETE FROM empleado_rol WHERE empleado_id=? AND rol_id=$rolID");
        return $stmt->execute([$empleadoID, $rolID]);
    }

    public function deleteAllByEmpleadoId($empleadoID)
    {
        $stmt = $this->conexion->prepare("DELETE FROM empleado_rol WHERE empleado_id = ?");
        return $stmt->execute([$empleadoID]);
    }
}
