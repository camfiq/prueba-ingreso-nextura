<?php
class Conexion
{

    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $host = "localhost";
        $dbname = "prueba_nexura";
        //Modificar si por algún motivo la DB por Default no tiene este usuario y clave
        $user = "root";
        $pass = "";

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Conexion();
        }
        return self::$instance->pdo;
    }
}
