<?php

namespace App\Util;

use PDO, PDOException;

class DBContext
{
    private static $db = null;

    public static function initialize()
    {
        if (empty(self::$db)) {
            try {
                self::$db = new PDO('sqlite:database.sqlite');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    public static function getInstance()
    {
        return self::$db;
    }

    public static function generateSchema()
    {
        $command = '
        CREATE TABLE IF NOT EXISTS todolist (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(100) NOT NULL,
            status VARCHAR(20) NOT NULL
        )';

        try {
            self::$db->exec($command);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}