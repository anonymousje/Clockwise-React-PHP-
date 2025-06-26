<?php
namespace App\Config;

use PDO;
use PDOException;

class DB {
    public static function getConnection(): PDO {
        return new PDO('mysql:host=localhost;dbname=clockwise', 'root', '');
    }
}
