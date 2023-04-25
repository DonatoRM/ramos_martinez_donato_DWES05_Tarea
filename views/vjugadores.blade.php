{{-- Se indica que la vista está heredada de plantilla.blade.php que está en el directorio plantillas --}}
@extends('plantillas.plantilla')
{{-- Se indica la primera sección que se llama titulo. El nombre titulo debe de coincidir con el nombre
    @yield('titulo') de la plantilla --}}
@section('titulo')
    {{-- Equivale a echo $titulo. Esta variable es la primera variable que insertamos con compact en el 
    fichero jugadores.php --}}
    {{ $titulo }}
@endsection {{-- Finaliza la sección de titulo --}}
{{-- Se indica la segunda sección que se llama encabezado. El nombre encabezado debe de coincidir con el nombre
    @yield('encabezado') de la plantilla --}}
@section('encabezado')
    {{-- Equivale a echo $encabezado. Esta variable es la segundo variable que insertamos con compact en el 
    fichero jugadores.php --}}
    {{ $encabezado }}
@endsection {{-- Finaliza la sección de encabezado --}}
{{-- Se indica la tercera sección que se llama contenido. El nombre contenido debe de coincidir con el nombre
    @yield('contenido') de la plantilla --}}
@section('contenido')
    {{-- Si existe la variable $mensaje (que se añadió desde el fichero jugadores.php) aparece un div con el
        mensaje --}}
    @if (isset($mensaje))
        <div class="alert alert-success">
            <p>{{ $mensaje }}</p>
    @endif {{-- Final del condicional --}}
    <div class="container">
        {{-- Se crea un formulario con un botón que, si lo pulsamos ejecuta el contenido del fichero 
            fcrear.php --}}
        <form class="d-flex justify-content-start mb-2" name="nuevo" method="POST" action="fcrear.php" target="_self">
            <button class="btn btn-verde-pistacho text-white" type="submit" name="nuevo">
                <span class="fa-solid fa-plus"></span> Nuevo Jugador
            </button>
        </form>
        {{-- Se crea la tabla en donde se mostrarán los registros de los jugadores junto con sus códigos de barras --}}
        <table class="container table table-dark table-striped">
            <thead>
                <tr class="">
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Posición</th>
                    <th scope="col">Dorsal</th>
                    <th scope="col">Código de Barras</th>
                </tr>
            </thead>
            <tbody>
                {{-- Bucle para iterar en cada uno de los registrso de los jugadores --}}
                @foreach ($todosJugadores as $jugador)
                    <tr class="text-center">
                        <td>{{ $jugador['apellidos'] . ', ' . $jugador['nombre'] }}</td>
                        <td>{{ $jugador['posicion'] }}</td>
                        {{-- Condicional que si no existe el dorsal, muestra Sin Asignar, y si existe muestra su 
                            valor --}}
                        @if (isset($jugador['dorsal']))
                            <td>{{ $jugador['dorsal'] }}</td>
                        @else
                            <td>Sin Asignar</td>
                        @endif
                        <td class="d-flex justify-content-center">
                            {{-- Muestra un pequeño código de PHP --}}
                            @php
                                /* Mediante el método getBarcodeHTML, indicamos el valor del código de barras,
                                 mediante $jugador['barcode'], el código a interpretar mediante EAN13, el número
                                 de veces que se repite el código de barras mediante el primer dígito 2, el 
                                 alto del la línea con el valor 33, y el color con white. */
                                echo $objetoCodigo->getBarcodeHTML($jugador['barcode'], 'EAN13', 2, 33, 'white');
                            @endphp {{-- Finaliza el código de PHP --}}
                        </td>
                    </tr>
                @endforeach {{-- Fin del bucle de iteración de jugadores --}}
            </tbody>
        </table>
    </div>
@endsection {{-- Finaliza la sección contenido --}}
