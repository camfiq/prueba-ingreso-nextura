<?php
class Area
{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function all()
    {
        $stmt = $this->conexion->query("SELECT * FROM areas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM areas WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conexion->prepare("INSERT INTO areas (nombre) VALUES (?)");
        return $stmt->execute([
            $data['nombre'],
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->conexion->prepare("UPDATE areas SET nombre=? WHERE id=?");
        return $stmt->execute([
            $data['nombre'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conexion->prepare("DELETE FROM areas WHERE id=?");
        return $stmt->execute([$id]);
    }
}
