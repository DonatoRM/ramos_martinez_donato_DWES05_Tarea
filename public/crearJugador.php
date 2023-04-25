<?php
// Inicializamos una sesión para almacenar Datos que luego servirán de comunicación entre las vistas
session_start();
require_once '../vendor/autoload.php'; // Cargamos el Autoload que nos proporciona Composer del PHP

use CifpACarballeira\DonatoRM\Jugador;

/**
 * Función que almacena un error en una variable de SESSION y ejecuta nuevamente el contenido del
 * fichero fcrear.php en donde será enviado a su vista, y desde allí será tratado
 * @param string $error Cadena de caracteres que especifica el error cometido 
 */
function errorDetectado($error)
{
    $_SESSION['error'] = $error;
    header('Location:fcrear.php');
    die();
}
$nombre = trim($_POST['nombre']); // Se prepara el nombre
$apellidos = trim($_POST['apellidos']); // Se preparan los apellidos
$posicion = trim($_POST['posicion']); // Se prepara la posición
$dorsal = trim($_POST['dorsal']); // Se prepara el dorsal
$codigoBarras = trim($_POST['codigoBarras']); // Se prepara el código de barras
/* Si la longitud de los campos nombre o apellidos es cero salta el error de que alguno de ellos
está vacío */
$valido = true;
if (strlen($nombre) === 0 || strlen($apellidos) === 0) {
    errorDetectado('Los campos de Nombre y Apellidos deben de estar rellenos');
    $valido = false;
}
$nuevoJugador = new Jugador(); // Se genera una instancia de la clase Jugador
/* Si el dorsal indicado ya está almacenado dentro de la BD se lanza el error diciendo que el
dorsal ya existe */
if (!$nuevoJugador->validDorsal($dorsal)) {
    $nuevoJugador = null;
    errorDetectado('El Dorsal indicado ya existe');
    $valido = false;
}
/* Si no hay errores se almacena el nuevo jugador en la BD */
$nuevoJugador->setJugador(ucwords($nombre), ucwords($apellidos), $dorsal, $posicion, $codigoBarras);
/* Se almacena en una variable de SESSION el mensaje de que todo a funcionado correctamente */
$_SESSION['mensaje'] = 'Jugador creado con éxito';
$nuevoJugador = null;
header('Location:jugadores.php'); // Ejecutamos nuevamente el contenido del fichero jugadores.php
die();
