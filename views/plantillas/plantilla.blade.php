<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css" media="all">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer>
    </script>
</head>

<body class="bg-fondo-naranja">
    <header class="text-center mt-2">
        <h3>@yield('encabezado')</h3>
    </header>
    <main class="text-center mt-3">
        @yield('contenido')
    </main>
</body>

</html>
