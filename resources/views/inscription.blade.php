<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription - Votre sonnette virtuel connecté</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/responsive.css") }}">
</head>
<body>
    
    <div class="Shellregister">

        <div style="text-align: center;">
            <img src="{{ asset("assets/images/logo_color.png") }}" width="350" class="Shellregister__title" />
        </div>

        <input type="text" class="Shellregister__username" placeholder="Votre nom d'utilisateur...">

        <input type="email" class="Shellregister__email" placeholder="Votre adresse email...">

        <button class="Shellregister__btnregister">Inscription</button>

    </div>

</body>
</html>