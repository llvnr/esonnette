<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yakelkun - Votre sonnette virtuelle</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/responsive.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    @vite('resources/css/app.css')
    
</head>
<body>

    <!-- L'élément HTML d'identifiant "app" -->
    <div id="app"></div>

    @vite('resources/js/app.js')

</body>
</html>