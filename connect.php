<?php

class Connect
{
    private static $serverName = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $database = 'portfolio';

    public static function connectTo()
    {
        try {
            $conn = new PDO("mysql:host=" . self::$serverName . ";dbname=" . self::$database, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}

Connect::connectTo();

?>