<?php
// Inicializamos una sesión para almacenar Datos que luego servirán de comunicación entre las vistas
session_start();
require_once '../vendor/autoload.php'; // Cargamos el Autoload que nos proporciona Composer del PHP

use CifpACarballeira\DonatoRM\Jugador;
use Faker\Factory;

define('CANTIDAD', 25); // Definimos el número de datos que inicialmente queremos darle a nuestra BD
// Creamos una instancia del generador, e indicamos que sea en castellano
$generador = Factory::create('es_ES');
$jugador = new Jugador(); // Creamos una instancia de la clase Jugador
/* Vamos a generar CANTIDAD de valores aleatorios y los vamos a almacenar en la BD */
for ($i = 0; $i < CANTIDAD; $i++) {
    $nombre = $generador->firstName; // Genera el Nombre
    $apellidos = $generador->lastName . ' ' . $generador->lastName; // Genera los 2 apellidos
    // Generamos un dorsal que no haya sido insertado en la BD
    do {
        $dorsal = $generador->numberBetween(1, CANTIDAD);
    } while (!$jugador->validDorsal($dorsal));
    // Devuelve un valor del array estático. Se pone [0] para que devuelve el primer elemento del array
    $posicion = $generador->randomElements($jugador::$posiciones, $count = 1)[0];
    //Generamos un código de barras ea13 que no esté almacenado en la BD
    do {
        $codigoBarras = $generador->ean13;
    } while (!$jugador->validBarcode($codigoBarras));
    $jugador->setJugador($nombre, $apellidos, $dorsal, $posicion, $codigoBarras); // Se almacena
}
$jugador = null; // Eliminamos el objeto $jugador
header('Location:jugadores.php'); // Ejecutamos el contenido del fichero jugadores.php
die();
