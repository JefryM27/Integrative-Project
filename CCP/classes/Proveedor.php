<?php
require_once '../db_connection.php';

class Proveedor
{
    private $id;
    private $nombre;
    private $cedula;
    private $direccion;
    private $telefono;
    private $email;

    // Constructor
    public function __construct($nombre, $cedula, $direccion, $telefono, $email, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // Save (insert/update) method
    public function save()
    {
        $conn = Database::getConnection();
        if ($this->id) {
            $sql = "UPDATE proveedores SET nombre = :nombre, cedula = :cedula, direccion = :direccion, telefono = :telefono, email = :email WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO proveedores (nombre, cedula, direccion, telefono, email) VALUES (:nombre, :cedula, :direccion, :telefono, :email)";
            $stmt = $conn->prepare($sql);
        }
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':cedula', $this->cedula);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);

        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $conn->lastInsertId();
            }
            return true;
        }
        return false;
    }

    // Delete method
    public function delete()
    {
        $conn = Database::getConnection();
        $sql = "DELETE FROM proveedores WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Static method to get a provider by ID
    public static function getById($id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM proveedores WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Retornamos un array con los datos en lugar de un objeto
            return [
                'id' => $result['id'],
                'nombre' => $result['nombre'],
                'cedula' => $result['cedula'],
                'direccion' => $result['direccion'],
                'telefono' => $result['telefono'],
                'email' => $result['email']
            ];
        }
        return null;
    }
}
