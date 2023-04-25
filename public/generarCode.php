<?php
// Inicializamos una sesión para almacenar Datos que luego servirán de comunicación entre las vistas
session_start();
require_once '../vendor/autoload.php'; // Cargamos el Autoload que nos proporciona Composer del PHP

use CifpACarballeira\DonatoRM\Jugador;
use Faker\Factory;
// Se crea una instancia del generador, con el idioma en castellano
$generador = Factory::create('es_ES');
$jugador = new Jugador(); // Se crea una instancia de la clase Jugador
/* Se genera un código de barras que no esté almacenado dentro de la BD */
do {
    $codigoBarras = $generador->ean13;
} while (!$jugador->validBarcode($codigoBarras));
/* Este código de barras se almacena en una variable de sesión para que puede ser leída desde el 
fichero fcrear.php, desde allí mismo volver a cargar la vista vcrear.blade.php, pero, esta vez con
el código de barras incrustado */
$_SESSION['codigo'] = $codigoBarras;
header('Location:fcrear.php');
die();
