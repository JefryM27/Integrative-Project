<?php
class Database
{
    private static $host = 'localhost';
    private static $db_name = 'cuentas_cobrar_pagar';
    private static $username = 'root';
    private static $password = 'Jairo8553';
    private static $conn;

    public static function getConnection()
    {
        self::$conn = null;

        try {
            self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return self::$conn;
    }
}