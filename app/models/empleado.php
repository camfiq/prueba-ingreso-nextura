<?php
class Empleado
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function create($data)
    {
        $sql = "INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            $data['boletin'],
            $data['descripcion']
        ]);
    }

    // Sin áreas
    public function all()
    {
        $sql = "SELECT * FROM empleados";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Con áreas
    public function allWithArea()
    {
        $sql = "SELECT e.*, a.nombre AS area
                FROM empleados e
                JOIN areas a ON e.area_id = a.id";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM empleados WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE empleados 
                SET nombre=?, email=?, sexo=?, area_id=?, boletin=?, descripcion=?
                WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            $data['boletin'],
            $data['descripcion'],
            $id
        ]);
    }

    // Eliminar empleado
    public function delete($id)
    {
        $sql = "DELETE FROM empleados WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$id]);
    }
}
