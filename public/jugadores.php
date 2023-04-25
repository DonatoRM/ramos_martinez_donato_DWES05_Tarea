<?php
// Inicializamos una sesión para almacenar Datos que luego servirán de comunicación entre las vistas
session_start();
require_once '../vendor/autoload.php'; // Cargamos el Autoload que nos proporciona Composer del PHP

use Philo\Blade\Blade;
use CifpACarballeira\DonatoRM\Jugador;
use Milon\Barcode\DNS1D;

$views = '../views'; // Ruta relativa de la carpeta views
$cache = '../cache'; // Ruta relativa de la carpeta cache

/* Se abre una instancia de la clase Blade con la que generaremos una nueva vista */
$blade = new Blade($views, $cache);
$titulo = 'Jugadores'; // Título de la vista
$encabezado = 'Listado de Jugadores'; // Encabezado de la vista

$objetoCodigo = new DNS1D(); // Se crea una instancia de la clase DNS1D
/* Para que funcione correctamente el generador de Códigos de Barras, es necesario que se le indique
mediante el método setStorOPath la carpeta en donde está la caché */
$objetoCodigo->setStorPath($cache);

$objJugadores = new Jugador(); // Se crea una instancia de la clase Jugador
/* Se vuelcan en un array todos los registros que están almacenados dentro de la BD, para luego 
trabajar con ellos en la vista */
$todosJugadores = $objJugadores->getJugadores();

/* Cuando se agregue un nuevo Jugador correctamente aparecerá un mensaje, y si este mensaje existe
la vista se dibuja con este mensaje, y si no existe este mensaje, no lo trabamos en la vista */
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    /* Se envían a la vista vjugadores las variables $titulo,$encabezado,$todosJugadores,$ObjetoCodigo y $Mensaje */
    echo $blade->view()->make('vjugadores', compact('titulo', 'encabezado', 'todosJugadores', 'objetoCodigo', 'mensaje'))->render();
} else {
    // Igual que arriba, pero esta vez sin la variable $mensaje
    echo $blade->view()->make('vjugadores', compact('titulo', 'encabezado', 'todosJugadores', 'objetoCodigo'))->render();
}
