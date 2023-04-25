<?php

namespace CifpACarballeira\DonatoRM;

use PDO;
use PDOException;

/**
 * Clase Jugador con la que controlamos todas las operaciones de los Jugadores
 * @author Donato Ramos Martínez
 */
class Jugador extends Conexion
{
    private int $id;
    private string $nombre;
    private string $apellidos;
    private int $dorsal;
    private string $posicion;
    private string $barcode;
    public static array $posiciones = ['Portero', 'Defensa', 'Lateral Izquierdo', 'Lateral Derecho', 'Central', 'Delantero'];
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Método que nos permite saber el número de Jugadores que están registrados en la BD
     * @return int Devuelve el número de registros en la BD
     */
    public function numeroJugadores(): int
    {
        $consulta = "SELECT count(*) AS cantidad FROM jugadores";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "No se ha podido contabilizar el número de jugadores de la BD. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
        $cantidad = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['cantidad'];
        return $cantidad;
    }
    /**
     * Método que permite saber si un Dorsal está o no está registrado en la BD
     * @param int $dorsal Valor del Dorsal a buscar en la BD
     * @return bool Devuelve true si el Dorsal no existe, y false si el Dorsal ya está registrado en la BD.
     */
    public function validDorsal(int $dorsal): bool
    {
        $consulta = "SELECT * from jugadores WHERE dorsal=:d";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':d' => $dorsal
            ]);
        } catch (PDOException $ex) {
            echo "No se ha podido realizar la consulta del Dorsal en la BD. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
        if ($stmt->rowCount() === 0) {
            return true;
        }
        return false;
    }
    /**
     * Método que permite saber si una Posición está o no está registrada en la BD
     * @param string $posicion Valor de la Posición a buscar en la BD
     * @return bool Devuelve false si la Posición no existe, y true si la Posición  está registrada en la BD.
     */
    public function validPosicion(string $posicion): bool
    {
        $consulta = "SELECT * FROM jugadores WHERE posicion=:p";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':p' => $posicion
            ]);
        } catch (PDOException $ex) {
            echo "No se ha podido realizar la consulta de la posición en la BD. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
        if ($stmt->rowCount() === 0) {
            return false;
        }
        return true;
    }
    /**
     * Método que permite saber si Código de Barras está o no está registrado en la BD
     * @param string $barcode Valor del Código de Barras a buscar en la BD
     * @return bool Devuelve false si el Código de Barras no existe, y true si el Código de Barras está registrada en la BD.
     */
    public function validBarcode(string $barcode): bool
    {
        $consulta = "SELECT * FROM jugadores WHERE barcode=:b";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':b' => $barcode
            ]);
        } catch (PDOException $ex) {
            echo "No se ha podido realizar la consulta del código de barras en la BD. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
        if ($stmt->rowCount() === 0) {
            return true;
        }
        return false;
    }
    /**
     * Método que inserta un Jugador en la BD
     * @param string $nombre Indica el nombre
     * @param string $apellidos Indica los apellidos
     * @param string $dorsal Indica el dorsal
     * @param string $posicion Indica la posición
     * @param string $codigoBarras Indica el código de barras
     */
    public function setJugador(string $nombre, string $apellidos, int $dorsal, string $posicion, string $codigoBarras)
    {
        $consulta = "INSERT INTO jugadores(nombre,apellidos,dorsal,posicion,barcode) VALUES(:n,:a,:d,:p,:c)";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':n' => $nombre,
                ':a' => $apellidos,
                ':d' => $dorsal,
                ':p' => $posicion,
                ':c' => $codigoBarras
            ]);
        } catch (PDOException $ex) {
            echo "No se ha podido insertar el jugador en la BD. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
    }
    /**
     * Método que devuelve un array con todos los datos de los Jugadores que están registrados en la BD
     * @return array Devuelve un array con todos los datos de los Jugadores
     */
    public function getJugadores(): array
    {
        $consulta = "SELECT * FROM jugadores ORDER BY posicion,apellidos";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "No se han podido consultar los jugadores. Mensaje: " . $ex->getMessage();
            $this->conexion = null;
            die();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
