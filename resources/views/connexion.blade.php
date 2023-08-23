<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion - Votre sonnette virtuel connecté</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/responsive.css") }}">
</head>
<body>
    
    <div class="Shellogin">

        <div style="text-align: center;">
            <img src="{{ asset("assets/images/logo_color.png") }}" width="350" class="Shellogin__title" />
        </div>

        <input type="email" class="Shellogin__email" placeholder="Votre adresse email...">

        <button class="Shellogin__btnlogin">Connexion</button>

    </div>

</body>
</html>