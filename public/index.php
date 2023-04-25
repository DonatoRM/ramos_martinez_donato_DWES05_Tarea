<?php

use CifpACarballeira\DonatoRM\Jugador;

require_once "../vendor/autoload.php"; // Cargamos el Autoload que nos proporciona Composer del PHP

/* Creamos una instancia de la clase Jugador y comprobamos cuantos registros almacena mediante la
llamada al método numeroJugadores. Si no tiene registros ejecutamos el contenido del fichero 
instalacion.php. Si no es así, ejecutamos el contenido del fichero jugadores.php */
$jugadores = new Jugador();
if ($jugadores->numeroJugadores() === 0) {
    header('Location:instalacion.php');
    die();
} else {
    header('Location:jugadores.php');
    die();
}
