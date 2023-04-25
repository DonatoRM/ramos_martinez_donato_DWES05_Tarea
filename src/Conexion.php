<?php

namespace CifpACarballeira\DonatoRM;

use PDO;
use PDOException;

/**
 * Clase abstracta que controla la conexión con la BD
 * @author Donato Ramos Martínez
 */
abstract class Conexion
{
    private string $host;
    private String $user;
    private string $pass;
    private string $db;
    private float $port;
    private string $charset;
    protected PDO $conexion;
    /**
     * Constructor de la Clase
     * @param string $host Indica la URI del Servidor. Por defecto: localhost
     * @param string $user Indica el usuario de la BD. Por defecto: gestor
     * @param string $pass Indica la contraseña de la BD. Por defecto secreto
     * @param string $db Indica el nombre de la BD. Por defecto practicaunidad5
     * @param int $port Indica el puerto de la BD. Por defecto el 3306
     * @param string $charset Indica el juego de caracteres de la BD. Por defecto utf8mb4
     */
    public function __construct(string $host = 'localhost', string $user = 'gestor', string $pass = 'secreto', string $db = 'practicaunidad5', float $port = 3306, string $charset = 'utf8mb4')
    {
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
        try {
            $this->conexion = new PDO($dsn, $user, $pass);
        } catch (PDOException $ex) {
            echo "No se ha podido establecer la conexión con la BD. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->port = $port;
        $this->charset = $charset;
    }
}
