<?php

namespace Cursos\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $conexion = null;

    /**
     * Crea una única conexión a la base de datos para ahorrar recursos
     * 
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if (self::$conexion === null) {
            $config = require __DIR__ . '/../../config.php';

            try {
                self::$conexion = new PDO(
                    "mysql:host={$config['db_host']};dbname={$config['db_name']};charset={$config['db_charset']}",
                    $config['db_user'],
                    $config['db_pass']
                );
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error en la conexión a la base de datos: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}
