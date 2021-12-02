<?php


abstract class PDOFactory {
    private static string $DB_USER = "root";
    private static string $DB_PASSWORD = "";
    private static string $HOST = "localhost";
    const DATABASE = "hetic";
    private static $pdo;

    private function getMysqlConnection() {
        self::$pdo = new PDO("mysql:host=".self::$HOST.";dbname=hetic", self::$DB_USER, self::$DB_PASSWORD);
        self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    static protected function getConnection() : PDO
    {
        if(self::$pdo == null) {
            self::getMysqlConnection();
        }
        return self::$pdo;
    }

}