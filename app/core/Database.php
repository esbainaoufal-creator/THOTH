<?php
class Database
{
    private static $pdo;

    public static function getConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                "mysql:host=localhost;dbname=thoth_lms;charset=utf8",
                "root",
                "rif50"
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$pdo;
    }
}
