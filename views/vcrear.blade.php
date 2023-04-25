{{-- Se indica que la vista está heredada de plantilla.blade.php que está en el directorio plantillas --}}
@extends('plantillas.plantilla')
{{-- Se indica la primera sección que se llama titulo. El nombre titulo debe de coincidir con el nombre
    @yield('titulo') de la plantilla --}}
@section('titulo')
    {{-- Equivale a echo $titulo. Esta variable es la primera variable que insertamos con compact en el 
    fichero fcrear.php --}}
    {{ $titulo }}
@endsection {{-- Finaliza la sección de titulo --}}
{{-- Se indica la segunda sección que se llama encabezado. El nombre encabezado debe de coincidir con el nombre
    @yield('encabezado') de la plantilla --}}
@section('encabezado')
    {{-- Equivale a echo $encabezado. Esta variable es la segunda variable que insertamos con compact en el 
    fichero fcrear.php --}}
    {{ $encabezado }}
@endsection {{-- Finaliza la sección de encabezado --}}
{{-- Se indica la tercera sección que se llama contenido. El nombre contenido debe de coincidir con el nombre
    @yield('contenido') de la plantilla --}}
@section('contenido')
    <div class="container">
        {{-- Se crea un formulario en dodne se insertarán todos los parámetros a añadir de un Jugador en la
            BD --}}
        <form class="" name="crear" method="post" action="crearJugador.php" target="_self">
            <div class="row mb-4">
                <div class="col-6 text-start">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div class="col-6 text-start">
                    <label class="form-label" for="apellidos">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col text-start">
                    <label class="form-label" for="dorsal">Dorsal</label>
                    <input class="form-control" type="number" name="dorsal" id="dorsal" placeholder="Dorsal">
                </div>
                <div class="col text-start">
                    <label class="form-label" for="posicion">Posición</label>
                    <select class="form-select" name="posicion" id="posicion">
                        <option value="1">Portero</option>
                        <option value="2">Defensa</option>
                        <option value="3">Lateral Izquierdo</option>
                        <option value="4">Lateral Derecho</option>
                        <option value="5">Central</option>
                        <option value="6">Delantero</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label" for="codigoBarras">Código de Barras</label>
                    {{-- Condicional que indica que si no existe el código de barras (indicado dentro del array de
                         variables del fichero fcrear.php) no se añade nada, y si existe se añade. Este campo es de
                          sólo lectura --}}
                    @if (!isset($codigoBarras))
                        <input class="form-control" type="text" name="codigoBarras" id="codigoBarras"
                            placeholder="Código de Barras" readonly>
                    @else
                        <input class="form-control" type="text" name="codigoBarras" id="codigoBarras"
                            placeholder="Código de Barras" value="{{ $codigoBarras }}" readonly>
                    @endif {{-- Fin del condicional --}}
                </div>
            </div>
            <div class="mb-4 text-start">
                {{-- Condicional que chequea si existe código de barras (proporcionado por el array de variables 
                    enviado desde el fichero fcrear.php). Si no existe el botón está deshabilitado y si existe el
                    boton se habilita --}}
                @if (!isset($codigoBarras))
                    <button class="btn btn-azul-brillante text-white disabled" type="submit" name="crear">Crear</button>
                @else
                    <button class="btn btn-azul-brillante text-white" type="submit" name="crear">Crear</button>
                @endif {{-- Fin del condicional --}}
                <button class="btn btn-verde-pistacho text-white" type="reset" name="limpiar">Limpiar</button>
                {{-- Boton para volver a la vista anterior ejecutando el fichero jugadores.php --}}
                <a class="btn btn-azul-cielo text-white" href="jugadores.php">Volver</a>
                {{-- Botón que ejecuta el contenido de l fichero generarCode.php para generar el Código de Brras --}}
                <a class="btn btn-gris-oscuro text-white" href="generarCode.php">
                    <span class="fa-solid fa-barcode"></span> Generar Barcode
                </a>
            </div>
        </form>
        {{-- Condicional que controla si existe algún tipo de error. Si es así (que se envía desde el array de variables
            del fichero fcrear.php) se muestra dentro de un div el error --}}
        @if (isset($error))
            <div class="alert alert-danger">
                <p>{{ $error }}</p>
            </div>
        @endif
    </div>
@endsection
