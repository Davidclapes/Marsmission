<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    	<div class="Header">
    		@include("layouts.header")
    		@yield("header")
    	</div>

          
    	<div class="Info">
    		@yield("informacio")
    	</div>
        <div class="Sidebar">
            @yield("side")
        </div>  
    	<div class="Footer">
    		@yield("footer")
    	</div>

    </body>
</html>
