<?php
class Rol
{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function all()
    {
        $stmt = $this->conexion->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM roles WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conexion->prepare("INSERT INTO roles (nombre) VALUES (?)");
        return $stmt->execute([
            $data['nombre'],
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->conexion->prepare("UPDATE roles SET nombre=? WHERE id=?");
        return $stmt->execute([
            $data['nombre'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conexion->prepare("DELETE FROM roles WHERE id=?");
        return $stmt->execute([$id]);
    }
}
