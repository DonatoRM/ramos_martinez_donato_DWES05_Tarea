<?php

require_once '../vendor/autoload.php'; // Cargamos el Autoload que nos proporciona Composer del PHP

/* Utilizaré una instancia de la clase Blade para cargar la vista vinstalacion e insertar en ella
 las variables titulo y encabezado */

use Philo\Blade\Blade;

$views = '../views'; // Indica la posición relativa del directorio views
$cache = '../cache'; // Indica la posición relativa del directorio cache

$blade = new Blade($views, $cache); // Creamos un objeto de la clase Blade
$titulo = 'Install';
$encabezado = 'Instalación';
echo $blade->view()->make('vinstalacion', compact('titulo', 'encabezado'))->render();
/* Se indica a dicho objeto que va a realizar una vista (view), y que ésta se hace (make) mediante
la vista vinstalacion y crea un array de variables (compact). Luego lo renderiza */