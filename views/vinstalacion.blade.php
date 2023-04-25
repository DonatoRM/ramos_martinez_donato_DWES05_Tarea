{{-- Se indica que la vista está heredada de plantilla.blade.php que está en el directorio plantillas --}}
@extends('plantillas.plantilla')
{{-- Se indica la primera sección que se llama titulo. El nombre titulo debe de coincidir con el nombre
    @yield('titulo') de la plantilla --}}
@section('titulo')
    {{-- Equivale a echo $titulo. Esta variable es la primera variable que insertamos con compact en el 
    fichero instalacion.php --}}
    {{ $titulo }}
@endsection {{-- Finaliza la sección de titulo --}}
{{-- Se indica la segunda sección que se llama encabezado. El nombre encabezado debe de coincidir con el nombre
    @yield('encabezado') de la plantilla --}}
@section('encabezado')
    {{-- Equivale a echo $encabezado. Esta variable es la segunda variable que insertamos con compact en el 
    fichero instalacion.php --}}
    {{ $encabezado }}
@endsection {{-- Finaliza la sección de encabezado --}}
{{-- Se indica la tercera sección que se llama contenido. El nombre contenido debe de coincidir con el nombre
    @yield('comntenido') de la plantilla --}}
@section('contenido')
    {{-- Se añade un formulario en cuyo interior hay un botón que al pulsarlo ejecuta el contenido del fichero
    crearDatos.php --}}
    <form name="instalacion" method="post" action="crearDatos.php" target="_self">
        <button class="btn btn-verde-pistacho text-white" type="submit" name="datos">
            <span class="fa-solid fa-database"></span> Instalar Datos de Ejemplo
        </button>
    </form>
@endsection {{-- Finaliza la sección de contenido --}}
