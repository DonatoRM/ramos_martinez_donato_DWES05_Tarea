<?php
// Inicializamos una sesión para almacenar Datos que luego servirán de comunicación entre las vistas
session_start();
require_once '../vendor/autoload.php'; // Cargamos el Autoload que nos proporciona Composer del PHP

use Philo\Blade\Blade;

$views = '../views'; // Ruta relativa de las vistas
$cache = '../cache'; // Ruta relativa de la caché
/* Instancia de la clase Blade con la que crearemos otra nueva vista, esta vez la de creación de
Jugadores nuevos. A su vez, como en las anteriores veces, también crearemos un array de variables 
que serán pasadas para la creación final de la vista */
$blade = new Blade($views, $cache);
$titulo = 'Nuevo'; // Definición del título
$encabezado = 'Crear Jugador'; // Definición del encabezado
/* En esta vista se mostrarán los mensajes de errores (cuando falta algún campo por rellenar o 
existe algún campo duplicado) y el código de barras si ya se ha creado */
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo $blade->view()->make('vcrear', compact('titulo', 'encabezado', 'error'))->render();
    unset($_SESSION['error']);
} else if (isset($_SESSION['codigo'])) {
    $code = $_SESSION['codigo'];
    echo $blade->view()->make('vcrear', compact('titulo', 'encabezado', 'codigoBarras'));
    unset($_SESSION['codigo']);
} else {
    echo $blade->view()->make('vcrear', compact('titulo', 'encabezado'));
}
